<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidOrderBiddingLog extends Model 
{
    
    protected $table = 'bid_order_bidding_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bidder_bid_registration_id', 'bid_timestamp'
    ];

   
    public function bidderbidregistration()
    {
        return $this->belongsTo('App\BidderBidRegistration');
    }
   
}
