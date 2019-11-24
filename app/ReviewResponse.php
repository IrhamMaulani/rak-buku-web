<?php

namespace App;

use App\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewResponse extends Model
{
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
