<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidOrder extends Model 
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'bid_start_time', 'base_price_in_currency', 'bidding_cost_in_bid_coin',
        'bid_end_time',  'bid_chair_cost_in_bid_coin', 'number_of_chairs_allowed',
        'increment_in_price_per_bid', 'increment_in_time_per_bid'
    ];

    /**
     * Get the product record associated with the bidorder.
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function bidderbidregistration()
    {
        return $this->hasOne('App\BidderBidRegistration');
    }
   
}
