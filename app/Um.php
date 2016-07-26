<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Um extends Model
{
    //
    protected $table = 'um';

    public function Users(){
    	return $this->belongsTo('App/Users', 'user_id');
    }

    public function Quest(){
    	return $this->belongsTo('App/Quest', 'quest_id');
    }
}
