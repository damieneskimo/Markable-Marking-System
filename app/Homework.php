<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mark;

use App\User;

use App\Homework;

use App\Comment;

class Homework extends Model
{
	protected $fillable = ['title', 'content'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function mark()
	{
		return $this->hasOne(Mark::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
    
}
