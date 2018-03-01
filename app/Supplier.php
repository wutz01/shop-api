<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    /*
     * This Supplier has many products
     */
    public function products () {
      return $this->hasMany('App\Product', 'supplierId');
    }
}
