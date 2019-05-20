<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lady;
use Carbon\Carbon;

class LadySchedulesController extends Controller
{
    public function index(){
        $ladies = Lady::select(["id", "name", "age", "height", "bwh", "blog_url", "price", "about"])
        ->with(['images' => function($query){
            $query->select('id', 'name', 'path', 'imageable_id', 'imageable_type');
        }])->with('schedules')->paginate(10);
        $dates = [];
        for($i=3;$i>-1;$i--){
            $prevdays = Carbon::now()->subDays($i)->toDateString();
            array_push($dates, $prevdays);
        }
        for($i=1;$i<6;$i++){
            $nextdays = Carbon::now()->addDays($i)->toDateString();
            array_push($dates, $nextdays);
        }
        $today = Carbon::now()->toDateString();
        
        return view('lady_schedule/main')->with([
            'ladies' => $ladies,
            'dates' => $dates,
            'today' => $today
        ]);
    }
}
