<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\compProduct;
use App\compProductPics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Notifications\reportcreated;
use Illuminate\Support\Facades\Auth;
use URL;
use Notification;


class CreateReportController extends Controller
{

  public function uploadForm()
  {
    $this->middleware('auth');
    return view('products');
  }

  public function view()
  {
    $user = Auth::user()->email;
    $report = DB::table('compProducts')
              ->join('departments', 'departments.department', '=', 'compProducts.department')
              ->join('users', 'departments.employeeId', '=', 'users.email')
              ->select(DB::raw("DATE_FORMAT(compProducts.created_at, '%Y %M') as date"),
              // 'compProducts.created_at', 'status', 'departments.department')->distinct()
              DB::raw('count(compProducts.id) as products'),
              DB::raw('status'),
              DB::raw('departments.department as department'))
              ->where('email', $user)
              ->whereIn('status', ['Not Submitted', 'Rejected'])
              ->groupBy('date', 'status', 'department')
              ->orderBy('date', 'desc')
              ->get();

    error_log("INFO: get /createreport");
    return view('createReport', compact('report'));
  }

  public function getProducts($date, $department, $status){

    $query = "SELECT c.id, store, description, regularPrice, salePrice, internalPrice, status, c.department, name, DATE_FORMAT(c.created_at, '%Y %M') as month
     FROM compproducts c
     JOIN users u
     ON c.employeeId = u.email
     WHERE DATE_FORMAT(c.created_at, '%Y %M') = '$date'
     AND c.department = '$department'
     AND c.status = '$status'
     order by store asc";
    $products = DB::select(DB::raw($query));

    $grabFirstForURL = "SELECT c.department,
    DATE_FORMAT(c.created_at, '%Y %M') as dater
     FROM compproducts c
     JOIN users u
     ON c.employeeId = u.email
     WHERE DATE_FORMAT(c.created_at, '%Y %M') = '$date'
     AND c.department = '$department'
     limit 1";
    $first = DB::select(DB::raw($grabFirstForURL));

    $picture = compProductPics::get();

    return view('viewmonthlyReport', compact('products', 'first', 'picture'));
  }

  public function submitAll(Request $request, $date, $department)
  {
    error_log("INFO: post/createreport");
    $validator = Validator::make($request->all(), [
        'id' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        error_log("ERROR: Approving report failed.");
        print $validator;
        return redirect('/createreport')
            ->withInput()
            ->withErrors($validator);
    }

    $data = $request->except(['_token']);

    $i = 0;

    foreach($data as $value){
      foreach($value as $val){
        print($val);
        $prod = compProduct::find($val);
        $prod->status = 'Submitted';
        $prod->submittedBy = Auth::user()->name;
        $prod->save();
        $i++;
      }
    }

    $usermanager =  "SELECT *
                     FROM users u join departments d
                     where u.id = d.id
                     and u.role != 'Merchant'
                     and d.department in ('$department')";
    $managers = DB::select(DB::raw($usermanager));
    $reporturl = URL::current();

    foreach($managers as $manageremail){
          $email = $manageremail->email;
          $name = $manageremail->name;
          Notification::route('mail', $email)->notify(new reportcreated($department, $date));
    }

     return redirect('/reports')->with('message', 'Report successfully approved!');
  }
}
