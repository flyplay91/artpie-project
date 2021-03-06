<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGallerys extends Model
{
    protected $fillable = [
        'coll_id', 'image', 'title', 'sign', 'frame', 'width', 'height', 'size', 'unit', 'actual_price', 'retail_price', 'check_enable_pieces', 'piece_count', 'materials', 'description', 'keywords', 'safe_children', 'category_id', 'artist_id', 'artist_name', 'paint_date', 'registered_date', 'updated_date',  'original', 'all_checked', 'title_ch', 'title_ko', 'description_ch', 'description_ko', 'artist_name_ch', 'artist_name_ko', 'resized_image'
    ];

    /**
     * Get all of the gallery's fragments.
     */
    public function fragments()
    {
        return $this->hasMany(GalleryFragments::class, 'gallery_id');
    }

    /**
     * Get all of the gallery's fragments.
     */
    public function availableFragments($userId)
    {
        return $this->hasMany(GalleryFragments::class, 'gallery_id')
            ->where('user_id', '<>', $userId)
            ->orderBy('sell_price')->orderBy('created_at', 'DESC');
    }

    /*
     * Get all of the gallery's orders.
     */
    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function category()
    {
        return $this->belongsTo(AdminCategories::class, 'category_id');
    }


    public function remainingPieces() {
        $fragments = $this->fragments()->get();
        $pieces = $this->piece_count;

        foreach($fragments as $fragment) {
            $pieces -= $fragment->piece_count;
        }

        return $pieces;
    }

    public function current_price() {
        if ($this->check_enable_pieces != 'yes') {
            return $this->retail_price;
        }

        $result = $this->retail_price / $this->piece_count * $this->remainingPieces();

        foreach($this->fragments as $fragment) {
            $result += $fragment->piece_count * $fragment->sell_price;
        }

        return $result;
    }
}
