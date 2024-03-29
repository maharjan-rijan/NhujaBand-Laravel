<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index(Request $request) {
        $events = Event::latest('id');
        if($request->get('keyword') !=" "){
            $events = $events->where('title','like','%'.$request->get('keyword').'%');
        }
        $events = $events->paginate();
        $data['events'] = $events;
        return view('admin.event.list',$data);
    }

    public function create() {
        return view('admin.event.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:events',
            'location' => 'required',
            'organizer' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        if($validator->passes()) {
            $event = new Event();
            $event->title = $request->title;
            $event->slug = $request->slug;
            $event->location = $request->location;
            $event->organizer = $request->organizer;
            $event->date = $request->date;
            $event->time = $request->time;
            $event->content = $request->content;
            $event->notice = $request->notice;
            $event->showHome = $request->showHome;
            $event->save();

            //Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $event->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/Event/'.$newImageName;
                File::copy($sPath,$dPath);

                $event->image = $newImageName;
                $event->save();

                //Delete old Image
                File::delete(public_path().'/temp/'.$tempImage->name);
                // File::delete(public_path().'/uploads/Member/'.$oldImage);

            }
        session()->flash('success','Event added successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Event added successfully.'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}

    public function edit($eventId, Request $request) {
        $event = Event::find($eventId);
        if(empty($event)){
            return redirect()->route('events.index');
        }

        return view('admin.event.edit',compact('event'));
    }

    public function update($eventId, Request $request){
        $event = Event::find($eventId);
        if(empty($event)){
            session()->flash('error','Record not found.');
         return response()->json([
            'status' => false,
            'notFound' => true,
            'message' => 'Record not found.'
         ]);
        }

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|unique:events,slug,'.$event->id.',id',
            'location' => 'required',
            'organizer' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        if($validator->passes()) {
            $event->title = $request->title;
            $event->slug = $request->slug;
            $event->location = $request->location;
            $event->organizer = $request->organizer;
            $event->date = $request->date;
            $event->time = $request->time;
            $event->content = $request->content;
            $event->notice = $request->notice;
            $event->showHome = $request->showHome;
            $event->save();

            //Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $event->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/Event/'.$newImageName;
                File::copy($sPath,$dPath);

                $event->image = $newImageName;
                $event->save();

                //Delete old Image
                File::delete(public_path().'/temp/'.$tempImage->name);
                // File::delete(public_path().'/uploads/Member/'.$oldImage);

            }
            session()->flash('success','Event updated successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Event updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destory($eventId, Request $request) {
        $event = Event::find($eventId);
        if(empty($event)){
            session()->flash('error','Record not found.');
            return response()->json([
                'status' => true,
                'message' => 'Record not found.'
            ]);
        }
        $event->delete();
        session()->flash('success','Event deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Event deleted successfully.'
        ]);
    }

    public function event($slug){
        $event = Event::where('slug',$slug)->first();
        $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
            $data['notice'] = $notice;
            $data['event'] = $event;
    return view('front.events-details',$data);
    }
}
