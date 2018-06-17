<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    //
    protected $fillable = [
        'domainName', 'menuTag', 'numberPage', 'limitOfOnePage', 'stringFirstPage', 'stringLastPage', 'ignoreWebsite', 'active'
    ];
    
    public function detailWebsites() {
    	// return $this->hasMany( ‘TenModel’ , ‘KhoaPhu’, ‘KhoaChinh’ );
    	return $this->hasMany('App\DetailWebsite');
    }

    public $timestamps = false;
}
