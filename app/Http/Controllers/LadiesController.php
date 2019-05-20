<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lady;
use App\Image;

class LadiesController extends Controller
{
    public function index(){
        $ladies = Lady::select(["id", "name", "age", "height", "bwh", "blog_url", "price", "about"])
        ->with(['images' => function($query){
            $query->select('id', 'name', 'path', 'imageable_id', 'imageable_type');
        }])->paginate(10);
        return view('ladies/main')->with("ladies", $ladies);
    }

    public function new(){
        return view('ladies/new');
    }

    public function store(Request $request){
        $lady =  new Lady();
        $lady->name = $request->name;
        $lady->age = $request->age;
        $lady->height = $request->height;
        $lady->bwh = $request->bwh;
        $lady->blog_url = $request->blogurl;
        $lady->price = $request->price;
        $lady->about = $request->about;
        if($lady->save()){
            return redirect('ladies/'.$lady->id.'/images');
        }
    }

    public function getImages($id){
        $images = Image::where("imageable_type", "App\Lady")->where("imageable_id", $id)->orderBy("order")->get();
        return view('ladies/images')->with([
            "images" => $images,
            "lady_id" => $id
        ]);
    }

    public function storeImages(Request $request){
        $allowedfileExtension=['jpg','png'];
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);

        if($check){
            $lady_img_dir = 'img/g_'.$request->lady_id.'/';
            if(!is_dir($lady_img_dir)){
                $mk = mkdir($lady_img_dir);
            }
            $stored = move_uploaded_file($file, public_path($lady_img_dir.'/'.$filename));
            if($stored){
                $image = new Image();
                $image->imageable_id = $request->lady_id;
                $image->imageable_type = 'App\Lady';
                $image->path = $lady_img_dir;
                $image->name = $filename;
                $image->order = 1;
                if($image->save()){
                    return true;
                }
            }
        }
    }
}
