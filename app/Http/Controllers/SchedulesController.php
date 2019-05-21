<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Link;
use App\Lady;
use Carbon\Carbon;

class SchedulesController extends Controller
{
    
    public function index(){
        //TODO add profile image fields to ladies table for better load
        $ladies = Lady::select(["id", "name", "age", "height", "bwh", "blog_url", "price", "about"])
        ->with(['images' => function($query){
            $query->select('id', 'name', 'path', 'imageable_id', 'imageable_type');
        }])->with('schedules')->paginate(10);
        $today = Carbon::now()->toDateString();
        return view('schedule.main')->with([
            'ladies' => $ladies,
            'today' => $today
        ]);
    }



    
}
