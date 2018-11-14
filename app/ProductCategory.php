<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model 
{   
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_category',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }
   
}
