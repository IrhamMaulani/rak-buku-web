<?php

namespace App;

use App\Book;
use App\AuthorImage;
use App\SocialMedia;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $hidden = array('pivot');
     protected $guarded = ['id'];

    /**
     * @deprecated
     * Check If user has Author Roles based on roles array containt author foreign key
     * roles is an array contain roles foreign_id 
     * @param array $roles
     *@return integer
     
     */
    public static function isAuthor($roles)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return (in_array('3', $roles) ? 1 : 0);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search === null) return $query;
        return $query->where("name", "LIKE", "%{$search}%")->orWhere('pen_name', "LIKE", "%{$search}%");
    }
     public static function slug($name){
        
        return str_slug($name, '-');
    }

    public function authorImage(){
        return $this->hasOne(AuthorImage::class);
    }

    public function socialMedias()
    {
          return $this->belongsToMany(
            SocialMedia::class,
            'author_social_media',
            'author_id',
            'social_media_id'
        );
    }

}
