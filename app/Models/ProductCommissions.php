<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCommissions extends Model
{
    protected $table = 'product_commissions';
    public function category(){
        return $this->hasOne('App\Categories', 'category_id');
    }
}
