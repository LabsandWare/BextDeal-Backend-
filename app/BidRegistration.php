<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidRegistration extends Model 
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

    /**
     * Get the user that owns the phone.
     */
    public function biddinglog()
    {
        return $this->belongsTo('App\BiddingLog');
    }
   
}
