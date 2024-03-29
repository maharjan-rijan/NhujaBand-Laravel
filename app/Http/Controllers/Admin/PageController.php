<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\TempImage;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request){
        $pages = Page::orderBy('id','ASC');
        if(!empty($request->get('keyword'))) {
            $pages = $pages->where('name','like','%'.$request->get('keyword').'%');
        }
        $pages = $pages->paginate(10);
        $data['pages'] = $pages;
        return view('admin.page.list', $data);
    }
    public function create() {
        return view('admin.page.create');
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        $page = new Page();
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->location = $request->location;
        $page->email = $request->email;
        $page->facebookUrl = $request->facebookUrl;
        $page->instagramUrl = $request->instagramUrl;
        $page->youtubeUrl = $request->youtubeUrl;
        $page->phone = $request->phone;
        $page->content = $request->content;
        $page->save();

         //Save Image
         if(!empty($request->image_id)){
            $tempImage = TempImage::find($request->image_id);
            $extArray = explode('.',$tempImage->name);
            $ext = last($extArray);

            $newImageName = $page->id.'-'.time().'.'.$ext;
            $sPath = public_path().'/temp/'.$tempImage->name;
            $dPath = public_path().'/uploads/Page/'.$newImageName;
            File::copy($sPath,$dPath);

            $page->image = $newImageName;
            $page->save();
         }

        $message = 'Page added successfully.';

        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
    public function edit($id){
        $page = Page::find($id);
        $message = 'Page not found.';
        if($page == null){
            session()->flash('error',$message);
        }
        return view('admin.page.edit',[
            'page' => $page
        ]);
    }
    public function update(Request $request, $id) {
        $page = Page::find($id);
        $message = 'Page not found.';
        if($page == null){
            session()->flash('error',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->location = $request->location;
        $page->email = $request->email;
        $page->facebookUrl = $request->facebookUrl;
        $page->instagramUrl = $request->instagramUrl;
        $page->youtubeUrl = $request->youtubeUrl;
        $page->phone = $request->phone;
        $page->content = $request->content;
        $page->save();

        $message = 'Page updated successfully.';

        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
    public function destory($id) {
        $page = Page::find($id);
        $message = 'Page not found.';
        if($page == null){
            session()->flash('error',$message);
            return response()->json([
                'status' => true,
            ]);
        }
        $page->delete();
        $message = 'Page deleted successfully.';

        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}
