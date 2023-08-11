<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\photo;
use Illuminate\Support\Facades\File;




class ImageController extends Controller
{
    public function index(){
        return view('tpl.index');
    }

    public function upload(Request $request){
        $validation = Validator::make($request->all(),[
            'title'=>'required|min:3',
            'image'=>'required|image'
        ]);

        if($validation->fails()){
            return Redirect::to('/')->withInput()->withErrors($validation);
        }else{
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $filename = pathinfo($filename,PATHINFO_FILENAME);
            $fullname = Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();
            $upload = $image->move(Config::get('image.uploads_folder'),$filename);
            Image::make(Config::get('image.uploads_folder') . '/' . $fullname)
            ->resize(Config::get('image.thumb_with'), Config::get('image.thumb_height'))
            ->save(Config::get('image.thumb_folder') . '/' . $fullname);

            if($upload){
                $insert_id = DB::table('photos')->insertGetId(array(
                    'title'=>$request->input('title'),
                    'image'=>$fullname
                ));
                return Redirect::to(URL::to('snath/'.$insert_id))->with('success','Your image is sucessfully uploaded!');
            }else{
                return Redirect::to('/')->withInput()->with('error','Sorry, Image Could not be uploaded, Please try again!');
            }
        }
    }

    public function snatch($id){
        $image = Photo::find($id);

        if($image){
            return view('tpl.permalink')->with('image',$image);
        }else{
            return Redirect::to('/')->with('error','Image not found!');
        }
    }

    public function delete($id){
        $image = Photo::find($id);

        if($image){
            File::delete(Config::get('image.uploads_folder').'/'.$image->image);
            File::delete(Config::get('image.thumb_folder') . '/' . $image->image);
            $image->delete();
            return Redirect::to('/')->with('success','Image deleted sucessfully!');
        }else{
            return Redirect::to('/')->with('error','No image found!');
        }
    }

    public function all(){
        $all_images = DB::table('photos')->orderBy('id','desc')->paginate();
        return view('tpl.all_images')->with('images',$all_images);
    }

}
