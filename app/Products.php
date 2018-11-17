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
        'actual_cost_in_currency',  'product_image',
        'product_category_id'
    ];

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }
    
    /**
     * Get the product that owns the bidorder.
     */
    public function bidorder()
    {
        return $this->hasOne('App\Product');
    }

    /**
     * Get the user that owns the bidorder.
     */
    public function productcategory()
    {
        return $this->belongsTo('App\ProductCategory');
    }

}
