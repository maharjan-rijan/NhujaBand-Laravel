<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\TeamMember;
use App\Models\TempImage;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index(Request $request) {
        $members = TeamMember::orderBy('id','ASC');
        if($request->get('keyword') !=" "){
            $members = $members->where('name','like','%'.$request->keyword.'%');
        }
        $members = $members->paginate(10);
        //dd($products);
        $data['team_members'] = $members;
        return view('admin.team-members.list',$data);
    }

    public function create() {
        return view('admin.team-members.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:team_members',
            'band_role' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if($validator->passes()) {
            $members = new TeamMember();
            $members->name = $request->name;
            $members->slug = $request->slug;
            $members->band_role = $request->band_role;
            $members->email = $request->email;
            $members->facebookUrl = $request->facebookUrl;
            $members->instagramUrl = $request->instagramUrl;
            $members->phone = $request->phone;
            $members->save();

            //Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $members->name.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/member/'.$newImageName;
                File::copy($sPath,$dPath);

                $members->image = $newImageName;
                $members->save();

                //Delete old Image
                File::delete(public_path().'/temp/'.$tempImage->name);
                // File::delete(public_path().'/uploads/Member/'.$oldImage);

            }
        session()->flash('success','New Member added successfully.');
        return response()->json([
            'status' => true,
            'message' => 'New Member added successfully.'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}

    public function edit($memberId, Request $request) {
        $members = TeamMember::find($memberId);
        if(empty($members)){
            return redirect()->route('team-members.index');
        }

        return view('admin.team-members.edit',compact('members'));
    }

    public function update($memberId, Request $request){

        $members = TeamMember::find($memberId);
        if(empty($members)){
            session()->flash('error','Member not found.');
         return response()->json([
            'status' => false,
            'notFound' => true,
            'message' => 'Member not found.'
         ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:team_members,slug,'.$members->id.',id',
            'band_role' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if($validator->passes()) {
            $members->name = $request->name;
            $members->slug = $request->slug;
            $members->band_role = $request->band_role;
            $members->email = $request->email;
            $members->facebookUrl = $request->facebookUrl;
            $members->instagramUrl = $request->instagramUrl;
            $members->phone = $request->phone;
            $members->save();

             //Save Image
             if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $members->name.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/member/'.$newImageName;
                File::copy($sPath,$dPath);

                $members->image = $newImageName;
                $members->save();

                //Delete old Image
                File::delete(public_path().'/temp/'.$tempImage->name);
                // File::delete(public_path().'/uploads/Member/'.$oldImage);

            }

            session()->flash('success','Member updated successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Member updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destory($memberId, Request $request) {
        $members = TeamMember::find($memberId);
        if(empty($members)){
            session()->flash('error','Member not found.');
            return response()->json([
                'status' => true,
                'message' => 'Member not found.'
            ]);
        }
        $members->delete();
        session()->flash('success','Member deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Member deleted successfully.'
        ]);
    }
}




