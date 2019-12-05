<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
      public function authors()
    {
          return $this->belongsToMany(
            Author::class,
            'author_social_media',
            'social_media_id',
            'author_id'
            
        );
    }
}
