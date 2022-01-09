<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'address_1', 'address_2', 'address_3', 'address_4', 'address_5', 'balance'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'paid_amount', 'available_income', 'available_profit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the users's fragments.
     */
    public function fragments()
    {
        return $this->hasMany(GalleryFragments::class);
    }

    /**
     * Get all of the users's fragments.
     */
    public function deposits()
    {
        return $this->hasMany(Deposits::class);
    }

    /**
     * checks if the user is super admin
     * @return bool
     */
    public function isSuperAdmin() {
        return $this->role == 'admin';
    }

    /**
     * checks if the user is investor
     * @return bool
     */
    public function isInvestor() {
        return $this->role == 'investor';
    }

    /**
     * checks if the user is buyer
     * @return bool
     */
    public function isBuyer() {
        return $this->role == 'buyer';
    }

    public function getPaidAmountAttribute()
    {
        $result = 0.00;
        
        foreach($this->fragments as $fragment) {
            $result += $fragment->piece_count * $fragment->buy_price;
        }

        return $result;
    }

    public function getAvailableIncomeAttribute()
    {
        $result = 0.00;
        
        foreach($this->fragments as $fragment) {
            $result += $fragment->piece_count * $fragment->sell_price;
        }

        return $result;
    }

    public function getAvailableProfitAttribute()
    {
        $result = 0.00;
        
        foreach($this->fragments as $fragment) {
            $result += $fragment->piece_count * ($fragment->sell_price - $fragment->buy_price);
        }

        return $result;
    }
}
