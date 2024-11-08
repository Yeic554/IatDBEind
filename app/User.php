<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'is_blocked'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class, 'borrower_id');
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewed_id');
    }
}
