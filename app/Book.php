<?php

namespace App;

use App\Tag;
use App\User;
use App\Score;
use App\Author;
use App\Review;
use App\Bookmark;
use App\BookImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $hidden = array('pivot');

    protected $guarded = ['id'];

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

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    public function userScore()
    {
        return $this->hasOne(Score::class)->whereUserId(User::getAuthId());
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function checkBookmarked()
    {
        return $this->hasOne(Bookmark::class)->whereUserId(User::getAuthId());
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function userReview()
    {
        return $this->hasOne(Review::class)->whereUserId(User::getAuthId());
    }

    public function scopeSearch($query, $search)
    {
        if ($search === null) return $query;
        return $query
            ->where("title", "ilike", "%%{$search}%%");
    }

    public function scopeTag($query, $tag)
    {
        if ($tag === null) return $query;

        return $query->whereHas('tags', function ($query) use ($tag) {
            $query->whereName($tag);
        });
    }

    public function scopeAuthor($query, $name)
    {
        if ($name === null) return $query;

        return $query->whereHas('authors', function ($query) use ($name) {
            $query->where('name', 'LIKE', "%{$name}%");
        });
    }

    public function scopePublisher($query, $publisher)
    {
        if ($publisher === null) return $query;

        return $query->whereHas('publisher', function ($query) use ($publisher) {
            $query->where('name', 'LIKE', "%{$publisher}%");
        });
    }

    public function scopeIsBookMarked($query, $userId)
    {
        return $query->whereHas('bookmarks', function ($query) use ($userId) {
            $query->whereUserId($userId);
        });
    }

    public static function slug($title, $volume, $edition)
    {

        $slug = $title . ' ' . $volume . ' ' . $edition;
        return str_slug($slug, '-');
    }

    public function getIdBySlug($slug)
    {
        return $this->whereSlug($slug)->first()->id;
    }

    public static function getIdForSync($arrays)
    {
        $ids = [];
        foreach ($arrays as $array) {
            $ids[] = $array->id;
        }
        return $ids;
    }
}
