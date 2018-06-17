<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = [
        'category_id', 'title', 'link', 'description', 'pubDate', 'sourceOfNews', 'active'
    ];

    public $timestamps = false;

}
