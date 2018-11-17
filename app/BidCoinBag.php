<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidCoinBag extends Model 
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bag_name', 'bid_coins', 
        'bonus_coins',  'cost_in_currency'
    ];
   
}
