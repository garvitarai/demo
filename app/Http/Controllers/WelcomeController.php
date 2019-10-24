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

class WelcomeController extends Controller
{
  public function WelcomeScreen()
  {
    return view('welcome');
  }

}
