<?php

namespace App;

use App\Book;
use App\User;
use App\ReviewResponse;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];

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

    public function scopeSearch($query, $search)
    {
        if ($search === null) return $query;
        return $query
            ->where("title", "LIKE", "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })->orWhereHas('book', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            });
    }

    public function scopeBook($query, $bookId){
         if ($bookId === null) return $query;

         return $query->whereBookId($bookId);
    }
}
