<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Homework;

use App\Mark;

use App\Comment;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'motto', 'thumbnail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
