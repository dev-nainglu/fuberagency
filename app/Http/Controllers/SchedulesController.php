<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Link;
use App\Lady;

class SchedulesController extends Controller
{
    
    public function index(){
        //TODO add profile image fields to ladies table for better load
        $ladies = Lady::select(["id", "name", "age", "height", "bwh", "blog_url", "price", "about"])
        ->with(['images' => function($query){
            $query->select('id', 'name', 'path', 'imageable_id', 'imageable_type');
        }])->with('schedules')->paginate(10);
        return view('schedule.main')->with([
            'ladies' => $ladies
        ]);
    }

    public function getData(){
        $tasks = new Task();
        $links = new Link();
 
        return response()->json([
            "data" => $tasks->all(),
            "links" => $links->all()
        ]);
    }

    public function store(Request $request){
 
        $task = new Task();
 
        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
 
        $task->save();
 
        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id
        ]);
    }
 
    public function update($id, Request $request){
        $task = Task::find($id);
 
        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
 
        $task->save();
 
        return response()->json([
            "action"=> "updated"
        ]);
    }
 
    public function destroy($id){
        $task = Task::find($id);
        $task->delete();
 
        return response()->json([
            "action"=> "deleted"
        ]);
    }

    
}
