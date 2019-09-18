<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get Id From Response in Array
     * @param array $roles
     * @todo change to collection
     * @return array
     */
    public static function getId($roles)
    {
        $ids = [];
        foreach ($roles as $role) {
            $ids[] = $role['id'];
        }
        return $ids;
    }
}
