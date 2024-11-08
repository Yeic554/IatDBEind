<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lending extends Model
{
    protected $fillable = [
        'product_id', 'lender_id', 'borrower_id', 'return_date', 'is_returned',
    ];

    protected $dates = ['return_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
