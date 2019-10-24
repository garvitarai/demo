<?php

namespace App\Http\Controllers;

use App\Task;
use App\compProduct;
use App\compProductPics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\report;

class ExportController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

  public function exportButton()
  {
  	//show table
     $data = \DB::table('compProducts')->get();
     return view('export', compact('data'));

    //return view('export');
  }

  public function export()
  {
	return (new report)->download('ComprReport.xlsx');
    }
}

