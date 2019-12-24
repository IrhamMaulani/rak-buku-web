<?php

namespace App;

use App\UserImage;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_author', 'reputation_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function reputation()
    {
        return $this->belongsTo('App\Reputation');
    }

    public static function getAuthId()
    {

        return auth('api')->user() != null ? auth('api')->user()->id : null;
    }

    public function imageProfile()
    {
        return $this->hasOne(UserImage::class)->whereIsUse(1);
    }

    public function isBan($userId)
    {
        return $this->findOrFail($userId)->is_ban === 1 ? true : false;
    }


    public function hasRole($roleName)
    {
        // $roles = explode("&", $roleNames);

        foreach ($this->roles as $role) {
            if ($role->name === $roleName) return true;
        }
        return false;
    }

    public function checkAdmin($userId)
    {
        $user = $this->findOrFail($userId);

        foreach ($user->roles as $role) {
            if ($role->name === 'moderator') return true;
        }
        return false;
    }

    /**
     * @deprecated
     * 
     * @param integer
     * 
     * @return string
     */
    public static function isAuthor($isAuthor)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return $isAuthor == 1 ? 'Author' : 'Bukan Author';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
