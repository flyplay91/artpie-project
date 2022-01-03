<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGallerys extends Model
{
    protected $fillable = [
        'coll_id', 'image', 'title', 'sign', 'frame', 'width', 'height', 'size', 'unit', 'actual_price', 'retail_price', 'check_enable_pieces', 'piece_count', 'materials', 'description', 'keywords', 'safe_children', 'category_id', 'artist_id', 'artist_name', 'paint_date', 'registered_date', 'updated_date',  'original', 'all_checked', 'title_ch', 'title_ko', 'description_ch', 'description_ko', 'artist_name_ch', 'artist_name_ko'
    ];

    /**
     * Get all of the gallery's fragments.
     */
    public function fragments()
    {
        return $this->hasMany(GalleryFragments::class);
    }

    /**
     * Get all of the gallery's orders.
     */
    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function remainingPieces() {
        return $this->role == 'admin';
    }
}
