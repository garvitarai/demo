<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Task;
use App\compProduct;
use App\compProductPics;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class ReportController extends Controller
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
              DB::raw('approvedBy'),
              DB::raw('departments.department as department'))
              ->where('email', $user)
              ->whereIn('status', ['Submitted', 'Approved'])
              ->groupBy('date', 'status', 'department', 'approvedBy')
              ->orderBy('status', 'desc')
              ->get();

    error_log("INFO: get /reports");
    return view('reports', compact('report'));
  }

  public function getProducts($date, $department, $status){

    $query = "SELECT c.id, store, description, regularPrice, salePrice, internalPrice, status, c.department, submittedBy, name, DATE_FORMAT(c.created_at, '%Y %M') as month
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

    return view('monthlyReport', compact('products', 'first', 'picture'));
  }

  public function approveAll(Request $request)
  {
    error_log("INFO: post/reports");
    $validator = Validator::make($request->all(), [
        'id' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        error_log("ERROR: Approving report failed.");
        print $validator;
        return redirect('/reports')
            ->withInput()
            ->withErrors($validator);
    }

    $data = $request->except(['_token', 'action']);

    $i = 0;

    foreach($data as $value){
      foreach($value as $val){
        print($val);
        $prod = compProduct::find($val);
        switch ($request->input('action')) {
          case 'approve':
            $prod->status = 'Approved';
            $prod->approvedBy = Auth::user()->name;
            break;
          case 'reject':
            $prod->status = 'Rejected';
            break;
        }
        $prod->save();
        $i++;
      }
    }

    return redirect('/reports')->with('message', 'Report successfully approved!');
  }
}
