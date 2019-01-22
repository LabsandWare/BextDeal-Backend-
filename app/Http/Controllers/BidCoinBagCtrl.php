<?php

namespace App\Http\Controllers;
 
use App\BidCoinBag;
use Illuminate\Http\Request;

class BidCoinBagCtrl extends Controller
{
  
  public function index(Request $request)
  {
      # code...
      $bid_coin_bag = BidCoinBag::all();

      return $bid_coin_bag;
  }

  public function store(Request $request)
  {
      $this->validate($request, [

          'bag_name' => 'required',
          'bid_coins' => 'required',
          'bonus_coins' => 'required',          
          'cost_in_currency' => 'required'         

      ]);
    
      $bag_name = $request->input('bag_name');
      $bid_coins = $request->input('bid_coins');
      $bonus_coins = $request->input('bonus_coins');
      $cost_in_currency = $request->input('cost_in_currency');
      
            
      $bid_coin_bag = BidCoinBag::create([
          'bag_name' => $bag_name, 
          'bid_coins' => $bid_coins,                   
          'bonus_coins' => $bonus_coins,                   
          'cost_in_currency' => $cost_in_currency
      ]);
      
      $bid_coin_bag->save();
      return $bid_coin_bag;
                  
  }

    public function show($id)
    {
      # code...
      $bid_coin_bag = BidCoinBag::findOrFail($id);

      return $bid_coin_bag;
    }

    public function update(Request $request, $id)
    {
        # code...
        $this->validate($request, [

          'bag_name' => 'required',
          'bid_coins' => 'required',
          'bonus_coins' => 'required',          
          'cost_in_currency' => 'required'              
        ]);

        $bid_coin_bag = BidCoinBag::findOrFail($id);

        if ($bid_coin_bag->fill($request->all())->save()) {
                # code...
                return response()->json(['success' => true]);
        }

        return response()->json(['status' => 'failed']);
    }
   
    public function destroy($id)
    {
      # code...
      $bid_coin_bag = BidCoinBag::findOrFail($id);
      $bid_coin_bag->delete();

      return response()->json(['success' => true]);
    }
        
}
 