<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLineItems extends Model
{
    protected $fillable = [
        'order_id', 'gallery_id', 'image', 'title', 'qty', 'price'
    ];
}
