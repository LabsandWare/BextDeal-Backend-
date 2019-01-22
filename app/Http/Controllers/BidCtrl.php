<?php

namespace App\Http\Controllers;

use App\Bidder;
use App\BidOrder;
use App\BidCoinBag;
use App\BidOrderBiddingLog;
use App\BidderBidRegistration;
use App\BidCoinTransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidCtrl extends Controller
{
  
  public function store(Request $request)
  {
      $this->validate($request, [

          'bid_order_id' => 'required',
          'coins_count' => 'required'        
      ]);
    
      $bid_order_id = $request->input('bid_order_id');
      $user_id = Auth::id();

      $bidder_id = Bidder::where('id', $user_id)->value('id');
      $registration_date = date("Y.m.d");
      $is_active = 'Y';

            
      $bidder_bid_registration = BidderBidRegistration::create([
          'bidder_id' => $bidder_id, 
          'registration_date' => $registration_date,                   
          'is_active' => $is_active,                   
          'bid_order_id' => $bid_order_id,                   
      ]);
      
      $bidder_bid_registration->save();

    
      $bid_timestamp = date("Y-m-d H:i:s");

      $bid_order_bidding_log = BidOrderBiddingLog::create([
        'bidder_bid_registration_id' => $bidder_bid_registration->id,
        'bid_timestamp' => $bid_timestamp
      ]);

      $bid_order_bidding_log->save();

      $transaction_type = 'Withdrawal';
      $transaction_date =  date("Y-m-d H:i:s");
      $coins_count = $request->input('coins_count');


      $bid_coin_transaction_log = BidCoinTransactionLog::create([
        'bidder_id' => $bidder_id, 
        'bid_order_bidding_log_id' => $bid_order_bidding_log_id->id,
        'bid_timestamp' => $bid_timestamp,
        'transaction_type' => $transaction_type,
        'transaction_date' => $transaction_date,
        'coins_count' => $coins_count
      ]);

  }
        
}
 