<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'shop_orders';

    public function items()
    {
        return $this->hasMany('App\Models\Shop\OrderItem', 'order_id');
    }
}
