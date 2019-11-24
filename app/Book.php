<?php

namespace App;

use App\Tag;
use App\User;
use App\Score;
use App\Author;
use App\Bookmark;
use App\BookImage;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $hidden = array('pivot');

    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function bookImages()
    {
        return $this->hasMany(BookImage::class);
    }

    public function bookImagesCover()
    {
        return $this->hasOne(BookImage::class)->whereIsCover(1);
    }

    public function score()
    {
        return $this->hasOne(Score::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function checkBookmarked()
    {
        return $this->hasMany(Bookmark::class)->whereUserId(1);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search === null) return $query;
        return $query
            ->where("title", "LIKE", "%{$search}%")
            ->orWhereHas('authors', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            });
    }

    public function scopeTag($query, $tag)
    {
        if ($tag === null) return $query;

        return $query->whereHas('tags', function ($query) use ($tag) {
            $query->whereName($tag);
        });
    }

    public function scopeIsBookMarked($query, $userId)
    {
        return $query->whereHas('bookmarks', function ($query) use ($userId) {
            $query->whereUserId($userId);
        });
    }
}
