<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //followsテーブルとのリレーション
    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow', 'follower');
    }
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow', 'follower');
    }
    // フォローする
    public function follow(Int $id)
    {
        return $this->follows()->attach($id);
    }

    // フォロー解除する
    public function unfollow(Int $id)
    {
        return $this->follows()->detach($id);
    }

}
