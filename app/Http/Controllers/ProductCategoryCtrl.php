<?php

namespace App\Http\Controllers;
 
use App\User;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;



class ProductCategoryCtrl extends Controller
{
  
  public function index(Request $request)
  {
      # code...
      $product_category = ProductCategory::all();

      return $product_category;
  }

  public function store(Request $request)
  {
      $this->validate($request, [

          'product_category' => 'required'          
      ]);
    
      $product_category = $request->input('product_category');
            
      $product_category = ProductCategory::create([
          'product_category' => $product_name                   
      ]);
      
      $product_category->save();
                  
  }

    public function show($id)
    {
      # code...
      $product_category = ProductCategory::findOrFail($id);

      return $product_category;
    }
   
    public function destroy($id)
    {
      # code...
      $product_category = ProductCategory::findOrFail($id);
      $product_category->delete();

      return response()->json(['success' => true]);
    }
        
}
 