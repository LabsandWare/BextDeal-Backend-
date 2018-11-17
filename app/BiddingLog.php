<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiddingLog extends Model 
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

    /**
     * Get the user that owns the phone.
     */
    public function bidregistration()
    {
        return $this->belongsTo('App\BidRegistration');
    }
   
}
