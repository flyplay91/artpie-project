<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id', 'gallery_id', 'billing_email', 'billing_phone', 'billing_address', 'billing_name', 'total_price', 'status'
    ];

    /**
     * Get the gallery.
     */
    public function gallery()
    {
        return $this->belongsTo(AdminGallerys::class);
    }
}
