<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminHeaderData extends Model
{
    protected $fillable = [
        'image', 'title', 'sub_title'
    ];
}
