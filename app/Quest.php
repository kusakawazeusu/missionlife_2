<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quest';

    public function Um(){
    	return $this->hasMany('App/Um', 'quest_id');
    }
}
