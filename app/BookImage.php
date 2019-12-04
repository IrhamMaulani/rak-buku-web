<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class BookImage extends Model
{
    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
