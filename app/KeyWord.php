<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyWord extends Model
{
    //
    protected $fillable = [
        'category_id', 'name', 'active'
    ];
    public $timestamps = false;

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
