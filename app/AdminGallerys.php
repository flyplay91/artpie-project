<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGallerys extends Model
{
    protected $fillable = [
        'coll_id', 'image', 'title', 'sign', 'frame', 'width', 'height', 'size', 'unit', 'actual_price', 'retail_price', 'check_enable_pieces', 'piece_count', 'materials', 'description', 'keywords', 'safe_children', 'category_id', 'artist_id', 'artist_name', 'paint_date', 'registered_date', 'updated_date',  'original', 'all_checked'
    ];

    /**
     * Default values for attributes
     * @var  array an array with attribute as key and default as value
     */
    protected $attributes = [
        'piece_count' => 0,
        'buy_price' => 0.00,
        'sell_price' => 0.00,
    ];

    /**
     * Get all of the gallery's fragments.
     */
    public function fragments()
    {
        return $this->hasMany(GalleryFragments::class);
    }

    /**
     * Get all of the gallery's fragments.
     */
    public function availableFragments($userId)
    {
        return $this->hasMany(GalleryFragments::class)
            ->where('user_id', '<>', $userId)
            ->orderBy('sell_price')->orderBy('created_at', 'DESC');
    }

    public function remainingPieces() {
        $fragments = $this->fragments();
        $pieces = $this->piece_count;

        foreach($fragments as $fragment) {
            $pieces -= $fragment->piece_count;    
        }

        return $pieces;
    }
}
