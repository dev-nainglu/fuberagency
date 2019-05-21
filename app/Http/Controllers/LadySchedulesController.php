<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lady;
use Carbon\Carbon;
use App\LadySchedule;

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

    public function saveSched(Request $request){
        $tos = $request->to;
        $froms = $request->from;
        foreach($tos as $to){
            $exp = explode("_", $to);
            $ladyid = $exp[0];
            $date = $exp[1];
            $time_to = $exp[2];
            $ladyschedtorow = LadySchedule::where("lady_id", $ladyid)->where("at_date", $date)->get();
            if(count($ladyschedtorow) > 0){
                $ladyschedrowtoupdate = LadySchedule::where("lady_id", $ladyid)->where("at_date", $date)->first();
                $ladyschedrowtoupdate->lady_id = $ladyid;
                $ladyschedrowtoupdate->time_to = $time_to;
                $ladyschedrowtoupdate->at_date = $date;
                $ladyschedrowtoupdate->save();
            }else{
                $ladyschedto = new LadySchedule();
                $ladyschedto->lady_id = $ladyid;
                $ladyschedto->time_to = $time_to;
                $ladyschedto->at_date = $date;
                $ladyschedto->save();
            }
        }
        foreach($froms as $from){
            $expfrom = explode("_", $from);
            $ladyid = $expfrom[0];
            $date = $expfrom[1];
            $time_from = $expfrom[2];
            $ladyschedfromrow = LadySchedule::where("lady_id", $ladyid)->where("at_date", $date)->get();
            if(count($ladyschedfromrow) > 0){
                $ladyschedrowfromupdate = LadySchedule::where("lady_id", $ladyid)->where("at_date", $date)->first();
                $ladyschedrowfromupdate->lady_id = $ladyid;
                $ladyschedrowfromupdate->time_from = $time_from;
                $ladyschedrowfromupdate->at_date = $date;
                $ladyschedrowfromupdate->save();
            }else{
                $ladyschedfrom = new LadySchedule();
                $ladyschedfrom->lady_id = $ladyid;
                $ladyschedfrom->time_from = $time_from;
                $ladyschedfrom->at_date = $date;
                $ladyschedfrom->save();
            }
        }
        return "success";
    }
}
