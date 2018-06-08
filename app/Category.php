<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function keyWords()
	{
		return $this->hasMany('App\KeyWord');
	}

	public function contents()
	{
		return $this->hasMany('App\Content');
	}
}
