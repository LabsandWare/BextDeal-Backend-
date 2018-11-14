<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model 
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 
        'joining_date',  'curr_bid_coins', 'date_of_birth'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
   
}
