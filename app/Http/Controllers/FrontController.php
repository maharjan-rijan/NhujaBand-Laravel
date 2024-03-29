<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\User;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $gallery = Gallery::latest('id')->get();
        $data['gallery'] = $gallery;

        $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
        $data['notice'] = $notice;
        return view('front.home',$data);
    }
    public function members(){
        $members = TeamMember::orderBy('id','DESC')->take(6)->get();
        $data['team_members'] = $members;

        $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
        $data['notice'] = $notice;
        return view('front.team-member',$data);
    }
    public function events(){
        $event = Event::orderBy('id','DESC')->take(6)->get();
        $data['event'] = $event;

        $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
        $data['notice'] = $notice;

        return view('front.event',$data);
    }

    // public function eventDetails($slug){
    //     $event = Event::find($slug);
    //     $data['event'] = $event;

    //     $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
    //     $data['notice'] = $notice;

    //     return view('front.event-details',$data);
    // }

    public function gallery(){

        $gallery = Gallery::orderBy('id','DESC')->take(6)->get();
        $data['gallery'] = $gallery;

        $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
        $data['notice'] = $notice;

        return view('front.gallery',$data);
    }

    public function page($slug){
        $notice = Event::where('notice',1)->orderBy('id','DESC')->where('showHome',1)->get();
        $data['notice'] = $notice;
        $page = Page::where('slug',$slug)->first();
        if ($page == null) {
            abort(404);
        }
        $data['page'] = $page;
        return view('front.page',$data);
    }

   public function sendContactEmail(Request $request){
     $validator = Validator::make($request->all(),[
        'name' => 'required',
        'email' => 'require|email',
        'subject' => 'required|min:10',
     ]);
     if ($validator->passes()) {
        //Send Email
        $mailDate = [
        'name' => $request->name ,
        'email' => $request->email ,
        'subject' => $request->subject,
        'message' => $request->message,
        'mail_subject' => 'You have received a contact email.'
        ];
        $user = User::where('role',2)->first();
        Mail::to($user->email)->send(new ContactEmail($mailDate));

        session()->flash('success','Thank You for contacting us, we will get back to you soon. ');
        return response()->json([
            'status' => true,
        ]);
     } else {
        return response()->json([
            'status' =>false,
            'errors' => $validator->errors()
        ]);
     }
   }
}
