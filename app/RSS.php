<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RSS extends Model
{
    //
    protected $fillable = [
        'link', 'ignoreRSS', 'website'
    ];
    public $timestamps = false;
}
