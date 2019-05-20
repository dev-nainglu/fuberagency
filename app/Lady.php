<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Lady extends Model
{
    use Rateable;
    protected $table = "ladies";

    public function images(){
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function schedules(){
        return $this->hasMany('App\LadySchedule');
    }
}
