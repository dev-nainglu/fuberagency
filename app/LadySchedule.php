<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LadySchedule extends Model
{
    protected $table = "lady_schedules";

    public function lady(){
        return $this->hasOne('App\Lady');
    }
}
