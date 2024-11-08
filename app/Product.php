<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'category', 'is_available', 'image_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }
}
