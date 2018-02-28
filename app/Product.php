<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'supplier_id'
  ];

  /**
   * The category that belong to the products.
   */
  public function categories()
  {
    return $this->belongsToMany('App\Category', 'categories_product', 'product_id', 'category_id');
  }

  /*
   * This Product belongs to a supplier
   */
  public function supplier () {
    return $this->belongsTo('App\Supplier');
  }

  /*
   * This Product has many images
   */
  public function images () {
    return $this->hasMany('App\ProductImages', 'productId');
  }
}
