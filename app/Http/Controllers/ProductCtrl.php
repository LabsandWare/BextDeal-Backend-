<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Product;
use App\ProductCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;



class ProductCtrl extends Controller
{

  public function index(Request $request)
  {
      # code...
      $product = Product::all();

      return $product;
  }

  /*
  **
  * Register new product
  *
  * @param $request Request
  */
  public function store(Request $request)
  {
      $this->validate($request, [
          'product_name' => 'required',
          'product_specification' => 'required',
          'actual_cost_in_currency' => 'required',
          'product_image' => 'required',
          'product_category' => 'required'    
      ]);
    
      $product_name = $request->input('product_name');
      $product_specification = $request->input('product_specification');
      $actual_cost_in_currency = $request->input('actual_cost_in_currency');
      $product_image = $request->input('product_image');
      $product_category = $request->input('product_category');     
        
      $product_category_id = ProductCategory::where('product_category', $product_category)->value('id');
     
      $product = Product::create([
          'product_name' => $product_name,
          'product_specification' => $product_specification,
          'actual_cost_in_currency' => $actual_cost_in_currency,
          'product_image' => $product_image, 
          'product_category_id' => $product_category_id,                     
      ]);

      $product->save();

      $res['data'] =$product;

      return response($res);
                  
  }
  
  public function show($id)
  {
    # code...
    $product = Product::findOrFail($id);

    return $product;
  }

  public function update(Request $request, $id)
  {
      # code...
      $this->validate($request, [

          'product_name' => 'required',
          'product_specification' => 'required',
          'actual_cost_in_currency ' => 'required',
          'product_image' => 'required',             
      ]);

      $product = Products::findOrFail($id);

      if ($product->fill($request->all())->save()) {
            # code...
            return response()->json(['success' => true]);
      }

      return response()->json(['status' => 'failed']);
  }


  public function destroy($id)
  {
      # code...
      $product = Product::findOrFail($id);
      $product->delete();

      return response()->json(['success' => true]);
  }
        
}
 