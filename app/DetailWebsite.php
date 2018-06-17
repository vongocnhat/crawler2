<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailWebsite extends Model
{
    //
    protected $fillable = [
        'website_id', 'containerTag', 'titleTag', 'descriptionTag', 'pubDateTag', 'active'
    ];

    public function website()
    {
        return $this->belongsTo('App\Website');
    }

    public $timestamps = false;
}
