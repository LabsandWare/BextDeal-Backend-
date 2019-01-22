<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidderBidRegistration extends Model 
{
   
    protected $table = 'bidder_bid_registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bidder_id', 'bid_order_id', 
        'registration_date',  'is_active'
    ];

    public function bidder()
    {
        return $this->belongsTo('App\Bidder');
    }

    public function bidorder()
    {
        return $this->belongsTo('App\BidOrder');
    }
    
    public function bidcointransactionlog()
    {
        return $this->hasOne('App\BidCoinTransactionLog');
    }

    public function bidorderbiddinglog()
    {
        return $this->hasOne('App\BidOrderBiddingLog');
    }
   
}
