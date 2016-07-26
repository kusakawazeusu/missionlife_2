<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';

    public function Um(){
    	return $this->hasMany('App/Um', 'user_id');
    }
}
