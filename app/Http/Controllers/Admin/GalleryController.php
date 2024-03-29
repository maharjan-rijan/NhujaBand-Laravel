<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Gallery;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request) {
        $galleries = Gallery::latest('id');
        if($request->get('keyword') !=" "){
            $galleries = $galleries->where('title','like','%'.$request->get('keyword').'%');
        }
        $galleries = $galleries->paginate();
        $data['galleries'] = $galleries;
        return view('admin.gallery.list',$data);
    }

    public function create() {
        return view('admin.gallery.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:galleries',
            'date' => 'required',
            'time' => 'required',
        ]);
        if($validator->passes()) {
            $gallery = new Gallery();
            $gallery->title = $request->title;
            $gallery->slug = $request->slug;
            $gallery->date = $request->date;
            $gallery->time = $request->time;
            $gallery->photographer = $request->photographer;
            $gallery->showHome = $request->showHome;
            $gallery->save();

            //Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $gallery->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/Gallery/'.$newImageName;
                File::copy($sPath,$dPath);

                $gallery->image = $newImageName;
                $gallery->save();

                //Delete old Image
                File::delete(public_path().'/temp/'.$tempImage->name);
                // File::delete(public_path().'/uploads/Member/'.$oldImage);

            }
        session()->flash('success','Gallery added successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Gallery added successfully.'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}

    public function edit($galleryId, Request $request) {
        $gallery = Gallery::find($galleryId);
        if(empty($gallery)){
            return redirect()->route('gallery.index');
        }

        return view('admin.gallery.edit',compact('gallery'));
    }

    public function update($galleryId, Request $request){
        $gallery = Gallery::find($galleryId);
        if(empty($gallery)){
            session()->flash('error','Record not found.');
         return response()->json([
            'status' => false,
            'notFound' => true,
            'message' => 'Record not found.'
         ]);
        }

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:galleries,slug,'.$gallery->id.',id',
            'date' => 'required',
            'time' => 'required',
        ]);

        if($validator->passes()) {
            $gallery->title = $request->title;
            $gallery->slug = $request->slug;
            $gallery->date = $request->date;
            $gallery->time = $request->time;
            $gallery->photographer = $request->photographer;
            $gallery->showHome = $request->showHome;
            $gallery->save();

            //Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $gallery->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/Gallery/'.$newImageName;
                File::copy($sPath,$dPath);

                $gallery->image = $newImageName;
                $gallery->save();

                //Delete old Image
            }
            session()->flash('success','Gallery updated successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Gallery updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destory($galleryId, Request $request) {
        // $tempImage = TempImage::find($request->image_id);
        // foreach($tempImage as $temp){
        //     $path = public_path('/temp/'.$temp->id);
        //      $dPath = public_path('/uploads/Gallery/'.$temp->id);
        //     if(File::exists($path)){
        //         File::delete($path);
        //     }

        //     if(File::exists($dpath)){
        //         File::delete($dpath);
        //     }
        // }
        $gallery = Gallery::find($galleryId);
        if(empty($gallery)){
            session()->flash('error','Record not found.');
            return response()->json([
                'status' => true,
                'message' => 'Record not found.'
            ]);
        }
        $gallery->delete();
        session()->flash('success','Gallery deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Gallery deleted successfully.'
        ]);
    }
}
