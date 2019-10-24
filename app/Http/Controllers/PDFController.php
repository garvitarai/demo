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

class PDFController extends Controller
{ 

public function uploadPDF()
  {
    $this->middleware('auth');
    return view('pdfview');
  }
	/*
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($date, $department, $status)
    {
       $query = "SELECT c.id, store, description, regularPrice, salePrice, internalPrice, status, c.department, submittedBy, name, DATE_FORMAT(c.created_at, '%Y %M') as month
     FROM compproducts c
     JOIN users u
     ON c.employeeId = u.email
     WHERE DATE_FORMAT(c.created_at, '%Y %M') = '$date'
     AND c.department = '$department'
     AND c.status = '$status'
     order by store asc";
    $products = DB::select(DB::raw($query));


      view()->share('compProducts', $products);

        $pdf = PDF::loadView('pdfview', compact ('products'));
        return $pdf->download('pdfview.pdf');
 }

}
