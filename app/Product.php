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
    return $this->belongsToMany('App\Category', 'categories_product', 'product_id', 'category_id');
  }

  /*
   * This Product belongs to a supplier
   */
  public function supplier () {
    return $this->belongsTo('App\Supplier');
  }
}
