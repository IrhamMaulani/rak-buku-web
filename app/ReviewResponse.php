<?php

namespace App;

use App\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewResponse extends Model
{
    protected $guarded = ['id'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
