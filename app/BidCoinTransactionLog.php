<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidCoinTransactionLog extends Model 
{
    
     protected $table = 'bid_coin_transaction_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bidder_id', 'bid_coin_bag_id', 'transaction_date',
        'bid_order_bidding_log_id',  'transaction_type', 'coins_count'
    ];

    
    public function bidder()
    {
        return $this->belongsTo('App\Bidder');
    }   

    public function bidorderbiddinglog()
    {
        return $this->belongsTo('App\BidOrderBiddingLog');
    }

    public function bidcoinbag()
    {
        return $this->belongsTo('App\BidCoinBag');
    }
   
}
