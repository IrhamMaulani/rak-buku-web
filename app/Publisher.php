<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $guarded = ['id'];

    public function book()
    {
        return $this->hasMany('App\Book');
    }

    public function scopeSearch($query, $search)
    {
        if ($search === null) return $query;
        return $query->where("name", "LIKE", "%{$search}%");
    }
}
