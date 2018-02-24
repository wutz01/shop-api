<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';

  /**
   * The category that belong to the products.
   */
  public function categories()
  {
    return $this->belongsToMany('App\Category', 'category_product', 'product_id', 'category_id');
  }
}
