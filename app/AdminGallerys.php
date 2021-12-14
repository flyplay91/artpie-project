<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGallerys extends Model
{
    protected $fillable = [
        'coll_id', 'image', 'title', 'sign', 'frame', 'width', 'height', 'size', 'unit', 'actual_price', 'retail_price', 'check_enable_pieces', 'piece_count', 'materials', 'description', 'keywords', 'safe_children', 'category_id', 'artist_id', 'paint_date', 'registered_date', 'updated_date',  'original', 'all_checked'
    ];
}
