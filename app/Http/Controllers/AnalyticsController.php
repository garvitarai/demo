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
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{

  public function analyticsAuth()
  {
    $this->middleware('auth');
    return view('analytics');
  }

	public function Analytics()
  {

    return view('analytics');
  }

} 