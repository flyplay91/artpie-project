<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminArtists extends Model
{
    protected $fillable = [
        'art_name', 'art_description',
    ];
}
