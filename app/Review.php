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

    public function selfResponse()
    {
        return $this->hasOne(ReviewResponse::class)->whereUserId(User::getAuthId());
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

    public function scopeSlug($query, $slug)
    {
        if ($slug === null) return $query;

        return $query->whereSlug($slug);
    }

    public function scopeBook($query, $bookId)
    {
        if ($bookId === null) return $query;

        return $query->whereBookId($bookId);
    }

    public function scopeIsUserIncluded($query, $isIncluded)
    {
        if ($isIncluded !== '1') return $query;

        return $query->where('user_id', '!=', User::getAuthId());
    }
}
