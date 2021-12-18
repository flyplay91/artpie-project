<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id', 'gallery_id', 'address_1', 'address_2', 'address_3', 'address_4', 'address_5', 'qty', 'price', 'total_price', 'status'
    ];
}
