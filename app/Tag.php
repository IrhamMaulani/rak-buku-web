<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    protected $hidden = array('pivot');

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public static function getId($tags)
    {
        $ids = [];
        foreach ($tags as $tag) {
            $ids[] = $tag['id'];
        }
        return $ids;
    }
}
