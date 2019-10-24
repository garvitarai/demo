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


class UploadController extends Controller
{

  public function uploadForm()
  {
    $this->middleware('auth');
    return view('products');
  }

  public function view()
  {
    $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    $images = [];
    $files = Storage::disk('s3')->files('images');
        foreach ($files as $file) {
            $images[] = [
                'name' => str_replace('images/', '', $file),
                'src' => $url . $file
            ];
        }

    $user = Auth::user()->email;
    $department = DB::table('departments')
                  ->select('department')
                  ->where('employeeId', $user)
                  ->first()
                  ->department;

    $products = DB::table('compProducts')->whereIn('status', ['Not Submitted', 'Rejected'])->orderBy('created_at', 'desc')->get();
    error_log("INFO: get /add");
    return view('products', compact('products', 'department'));
  }

  public function destroy($image)
  {
      Storage::disk('s3')->delete('images/' . $image);

      return back()->withSuccess('Image was deleted successfully');
  }

  public function uploadSubmit(Request $request)
  {
      error_log("INFO: post /compProduct");
      $validator = Validator::make($request->all(), [
          'employeeId' => 'required|max:255',
          'description' => 'nullable|max:255',
          // 'department' => 'required|max:255',
          'store' => 'required|max:255',
          'regularPrice' => 'nullable',
          'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'regularPrice' => 'nullable|numeric',
          'salePrice' => 'nullable|numeric',
          'internalPrice' => 'nullable|numeric',
      ]);

      if ($validator->fails()) {
          error_log("ERROR: Add product failed.");
          return redirect('/add')
              ->withInput()
              ->withErrors($validator);
      }

      $product = compProduct::create($request->all());
      $product->employeeId = $request->employeeId;
      $product->department = $request->department;
      $product->description = $request->description;
      $product->store = $request->store;
      $product->regularPrice = $request->regularPrice;
      $product->salePrice = $request->salePrice;
      $product->internalPrice = $request->internalPrice;

      foreach ((array)$request->pictures as $picture) {
          $file= $picture->store('public');
          Storage::disk('s3')->put($file, file_get_contents($picture));

          compProductPics::create([
              'productId' => $product->id,
              'picture' => 'thisIsAHack',
              'comments' => 'https://s3.ca-central-1.amazonaws.com/tjxcanada/' .$file
          ]);
      }

      $product->save();

      return redirect('/add');
  }
}
