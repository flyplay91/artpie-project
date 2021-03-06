<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCategories extends Model
{
    protected $fillable = [
        'cat_name', 'cat_name_ch', 'cat_name_ko',
    ];

    public function gallery()
    {
        return $this->hasOne(AdminGallerys::class, 'category_id');
    }
}
