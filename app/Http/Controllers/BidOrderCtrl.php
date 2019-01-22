<?php

namespace App\Http\Controllers;
 
use App\Product;
use App\BidOrder;
use Illuminate\Http\Request;

class BidOrderCtrl extends Controller
{
  
  public function index(Request $request)
  {
      # code...
      $bid_order = BidOrder::with('product')->get();

      return $bid_order;
  }

  public function store(Request $request)
  {
      $this->validate($request, [

          'product' => 'required',
          'bid_start_time' => 'required',
          'bid_end_time' => 'required',          
          'bid_chair_cost_in_bid_coin' => 'required',          
          'number_of_chairs_allowed' => 'required',         
          'base_price_in_currency' => 'required', 
          'increment_in_time_per_bid' => 'required',         
          'increment_in_price_per_bid' => 'required',         
          'bidding_cost_in_bid_coin' => 'required'          

      ]);
    
      $bid_start_time = $request->input('bid_start_time');
      $bid_end_time = $request->input('bid_end_time');
      $bid_chair_cost_in_bid_coin = $request->input('bid_chair_cost_in_bid_coin');
      $base_price_in_currency = $request->input('base_price_in_currency');
      $increment_in_price_per_bid = $request->input('increment_in_price_per_bid');
      $number_of_chairs_allowed = $request->input('number_of_chairs_allowed');
      $increment_in_time_per_bid = $request->input('increment_in_time_per_bid');
      $bidding_cost_in_bid_coin = $request->input('bidding_cost_in_bid_coin');
      $product = $request->input('product');

      $product_id = Product::where('product_name', $product)->value('id');
            
      $bid_order = BidOrder::create([
          'bid_start_time' => $bid_start_time, 
          'bid_end_time' => $bid_end_time,                   
          'product_id' => $product_id,                   
          'bid_chair_cost_in_bid_coin' => $bid_chair_cost_in_bid_coin,                   
          'base_price_in_currency' => $base_price_in_currency,                   
          'increment_in_price_per_bid' => $increment_in_price_per_bid,  
          'increment_in_time_per_bid' => $increment_in_time_per_bid,  
          'number_of_chairs_allowed' => $number_of_chairs_allowed,                   
          'bidding_cost_in_bid_coin' => $bidding_cost_in_bid_coin
      ]);
      
      $bid_order->save();
      return $bid_order;
                  
  }

    public function show($id)
    {
      # code...
      $bid_order = BidOrder::findOrFail($id);

      return $bid_order;
    }

    public function update(Request $request, $id)
    {
        # code...
        $this->validate($request, [

            'product' => 'required',
            'bid_start_time' => 'required',
            'bid_end_time' => 'required',          
            'bid_chair_cost_in_bid_coin' => 'required',          
            'number_of_chairs_allowed' => 'required',         
            'base_price_in_currency' => 'required', 
            'increment_in_price_per_bid' => 'required',         
            'increment_in_time_per_bid' => 'required',         
            'bidding_cost_in_bid_coin' => 'required'             
        ]);

        $bid_order = BidOrder::findOrFail($id);

        if ($bid_order->fill($request->all())->save()) {
                # code...
                return response()->json(['success' => true]);
        }

        return response()->json(['status' => 'failed']);
    }
   
    public function destroy($id)
    {
      # code...
      $bid_order = BidOrder::findOrFail($id);
      $bid_order->delete();

      return response()->json(['success' => true]);
    }
        
}
 