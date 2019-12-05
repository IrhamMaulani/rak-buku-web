<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
  protected $table = 'social_medias';

      public function authors()
    {
          return $this->belongsToMany(
            Author::class,
            'author_social_media',
            'social_media_id',
            'author_id'
            
        );
    }

    public function convertToInsertData($socialMedias){
      $social = [];
      $socialMediaArray = explode(",",$socialMedias);

      foreach ($socialMediaArray as $socialMedia) {
        $socialMediaName = explode(">",$socialMedia);
        $social[] = [
          'id' =>$this->whereName($socialMediaName[0])->first()->id ,
          'url' => $socialMediaName[1]
        ];
      }
      return $social;
    }
}
