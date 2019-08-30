<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public static function isAuthor($roles)
    {
        return (in_array('3', $roles) ? 1 : 0);
    }
}
