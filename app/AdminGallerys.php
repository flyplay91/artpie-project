<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGallerys extends Model
{
    protected $fillable = [
        'coll_id', 'image', 'title', 'size', 'price', 'category', 'artist_id', 'pieces_number', 'paint_date', 'registered_date', 'updated_date', 'frame', 'description', 'keywords', 'original', 'signed'
    ];
}
