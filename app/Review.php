<?php

namespace App;

use App\Book;
use App\User;
use App\ReviewResponse;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reviewResponses()
    {
        return $this->hasMany(ReviewResponse::class);
    }
}
