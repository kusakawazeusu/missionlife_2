<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Um extends Model
{
    //
    protected $table = 'um';

    public function User(){
    	return $this->belongsTo('App\User', 'user_id','id');
    }

    public function Quest(){
    	return $this->belongsTo('App\Quest', 'quest_id');
    }
}
