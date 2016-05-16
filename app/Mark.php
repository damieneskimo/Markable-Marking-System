<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

use App\Homework;

class Mark extends Model
{
	protected $fillable = ['mark'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function homework()
    {
    	return $this->belongsTo(Homework::class);
    }
}
