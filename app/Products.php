<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'product_specification', 
        'actual_cost_in_currency',  'product_image'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }
   
}
