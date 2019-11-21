<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $hidden = array('pivot');

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
}
