<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function book()
    {
        return $this->belongTo(Book::class);
    }
}
