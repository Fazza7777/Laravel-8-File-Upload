<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Symfony\Component\String\b;

class HomeController extends Controller
{
   public function index() {
       $galleries = Gallery::all();
    return view('welcome',compact('galleries'));
   }
   public function store(Request $request){
     // $file = $request->file('image');
    //$imgName = time()."_".str_replace(" ","",$file->getClientOriginalName());
    ## store public folder   
    //   $imgPath ="/images/";
    //   $file->move(public_path($imgPath),$imgName);

    ## store in store folder
    //  $request->file('image')->store('upload');
    //   $request->file('image')->storeAs('upload',$imgName); // own img name define
     $request->validate([
          "image"=>"required",
          "image.*"=>"image|mimes:jpeg,png,jpg,gif,svg|max:2048"
     ]);
    ##multiple store image
       if($request->hasFile('image')){
         foreach($request->file('image') as $image){
            $imgName = time()."_".str_replace(" ","", $image->getClientOriginalName());
            $image->storeAs('upload',$imgName);
            $gallery = new Gallery();
            $gallery->name = $imgName;
            $gallery->save();
         }   
       }
       return back()->with('status',"The images were uploaded!");
   }
   public function delete($id){
      $gallery = Gallery::findOrFail($id);
      Storage::delete("upload/".$gallery->name);
      $gallery->delete();  
      return back()->with('status',"The images were deleted!");
   }
   public function download($id){
       $gallery = Gallery::findOrFail($id);
       return Storage::download("upload/".$gallery->name);
   }
}
