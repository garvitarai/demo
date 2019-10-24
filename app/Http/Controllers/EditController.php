<?php
namespace App\Http\Controllers;
use App\Task;
use App\Product;
use App\compProduct;
use App\compProductPics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Session;
use URL;
use Redirect;
class EditController extends Controller
{
  public function EditPage()
  {
    return view('editMain');
  }
  public function EditForm($id)
  {
    $product = compProduct::where('id', $id)
                        ->first();
    $picture = compProductPics::where('productId', $id)
                        ->get();
    Session::put('requestReferrer', URL::previous());   
    return view('edit', compact('product', 'picture', 'id'));
  }

     protected function validator(array $request)
    {
        return Validator::make($request, [
          'description' => 'required|max:255',
          'store' => 'required|max:255',
          'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          'regularPrice' => 'required|numeric',
          'salePrice' => 'nullable|numeric',
          'internalPrice' => 'required|numeric',
        ]);
    }
    
  public function update(Request $request, $id)
  {
    $this->middleware('auth');
        $product = compProduct::find($id);

        $product->description = $request->get ('description');
        $product->store = $request-> get ('store');
        $product->regularPrice = $request-> get('regularPrice');
        $product->salePrice = $request->get('salePrice');
        $product->internalPrice = $request->get ('internalPrice');
        $product->save();
        return redirect(Session::get('requestReferrer'));
  }
}