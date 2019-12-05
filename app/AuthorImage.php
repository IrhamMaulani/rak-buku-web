<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class AuthorImage extends Model
{
      public function author(){
        return $this->belongsTo(Author::class);
    }
}
