<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

use App\Homework;

class Comment extends Model
{
    //
    protected $fillable = ['content'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function homework()
    {
    	return $this->belongsTo(Homework::class);
    }
}
