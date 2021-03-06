<?php

namespace App\Http\Controllers;
 
use App\User;
use App\ProductCategory;
use Illuminate\Http\Request;

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
          'product_category' => $product_category                   
      ]);
      
      $product_category->save();
      return $product_category;
                  
    }

    public function show($id)
    {
      # code...
      $product_category = ProductCategory::findOrFail($id);

      return $product_category;
    }
   
    public function update(Request $request, $id)
    {
      # code...
      $this->validate($request, [

          'product_category' => 'required'          
      ]);

      $product_category = ProductCategory::findOrFail($id);

      if ($product_category->fill($request->all())->save()) {
            # code...
            return response()->json(['success' => true]);
      }

      return response()->json(['status' => 'failed']);
    }

    public function destroy($id)
    {
      # code...
      $product_category = ProductCategory::findOrFail($id);
      $product_category->delete();

      return response()->json(['success' => true]);
    }
        
}
 