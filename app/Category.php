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

	public function keyWordsActive()
	{
		return $this->hasMany('App\KeyWord')->where('active', 1);
	}

	public function contents()
	{
		return $this->hasMany('App\Content');
	}

	public function contentsActive()
	{
		return $this->hasMany('App\Content')->where('active', 1);
	}

}
