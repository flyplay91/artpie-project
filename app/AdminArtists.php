<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminArtists extends Model
{
    protected $fillable = [
        'art_name', 'art_description', 'art_name_ch', 'art_description_ch', 'art_name_ko', 'art_description_ko'
    ];
}
