<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public function book()
    {
        $this->belongsTo(Book::class);
    }
}
