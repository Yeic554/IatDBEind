<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'lending_id', 'reviewer_id', 'reviewed_id', 'content', 'rating'
    ];

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewed()
    {
        return $this->belongsTo(User::class, 'reviewed_id');
    }
}
