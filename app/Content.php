<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = [
        'domainName', 'title', 'link', 'description', 'pubDate', 'body', 'active'
    ];
    public $timestamps = false;

}
