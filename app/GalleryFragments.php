<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryFragments extends Model
{
  	protected $fillable = [
      'user_id', 'gallery_id', 'piece_count', 'buy_price', 'sell_price'
  	];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

	/**
     * Get the parent gallery.
     */
    public function gallery()
    {
        return $this->belongsTo(AdminGallerys::class);
    }
}
