<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Product;
use App\Product_category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;



class ProductCtrl extends Controller
{
  /*
  **
  * Register new user
  *
  * @param $request Request
  */

   

  public function store(Request $request)
  {
      $this->validate($request, [

          'product_name' => 'required',
          'product_specification' => 'required',
          'product_price' => 'required',
          'quantity' => 'required',
          'product_category_name' => 'required',
          'product_category_description' => 'required',
          'product_image' => 'required',
          
      ]);
    
      $product_name = $request->input('product_name');
      $product_color = $request->input('product_color');
      $product_price = $request->input('product_price');
      $quantity = $request->input('quantity');
      $product_description = $request->input('product_description');
      $other_product_details = $request->input('other_product_details');
      $product_category_level = $request->input('product_category_level');
      $product_category_name = $request->input('product_category_name');
      $product_category_description = $request->input('product_category_description');
      $product_type_code = $request->input('product_type_code');
      $image = $request->input('product_image');
      
      log::info('All Input ' . $request->all());
      
      $product = Product::create([
          'product_name' => $product_name,
          'product_color' => $product_color,
          'actual_cost_in_currency' => $product_price,
          'product_specification' => $product_description,                      
      ]);

      $product->save();
      $productid=$product->id;

      

      //$productid=Product::find('id')->first();

      Log::info ('ii'. $productid);

      $product_category =$product-> product_cat()->create([
          'product_category_level' => $product_category_level,
          'product_category_name' => $product_category_name,
          'product_category_description' => $product_category_description,
          'product_id' =>  $productid,
      ]);
      $product_category->save();

      $res['success'] = true;
      $res['message'] = 'Success register!';
      $res['data'] =$product_category;
      return response($res);
                  
  }

  public function trial(Request $request)
  {
      # code...
      log::info (' is me trial '); 
  }
        
}
 