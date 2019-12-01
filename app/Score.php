<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $guarded = ['id'];

    public function book()
    {
        $this->belongsTo(Book::class);
    }
}
