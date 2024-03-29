<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\TempImage;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::orderBy('id','ASC');
        if(!empty($request->get('keyword'))) {
            $users = $users->where('name','like','%'.$request->get('keyword').'%');
            $users = $users->orWhere('email','like','%'.$request->get('keyword').'%');
        }
        $users = $users->paginate(10);
        return view('admin.user.list',['users' => $users]);
    }
    public function create(Request $request){
        return view('admin.user.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'password' =>'required|min:8',
            'email' => 'required|email|unique:users',
            'phone' =>'required'
        ]);
        if($validator->passes()){
            $user = new User();
            $user->image = $request->image;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->status = $request->status;
            $user->save();

            //Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $user->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/user/'.$newImageName;
                File::copy($sPath,$dPath);

                $user->image = $newImageName;
                $user->save();

                // //Delete old Image
                // File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
                // File::delete(public_path().'/uploads/category/'.$oldImage);

            }
            session()->flash('success','User added successfully.');
            return response()->json([
                'status' => true,
                'message' => 'User added successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $id){
        $user = User::find($id);
        if($user == null){
            $message = 'User not found.';
            session()->flash('success',$message);
            return redirect()->route('users.index');
        }
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if($user == null){
            $message = 'User not found.';
            session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'phone' =>'required'
        ]);
        if($validator->passes()){
            $user->image = $request->image;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if($request->password != ' ') {
                $user->password = Hash::make($request->password);
            }
            $user->role = $request->role;
            $user->status = $request->status;
            $user->save();

            $oldImage = $user->image;

            // Save Image
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $user->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/user/'.$newImageName;
                File::copy($sPath,$dPath);

                $user->image = $newImageName;
                $user->save();

                // // Delete old Image
                // File::delete(public_path().'/uploads/user/thumb/'.$oldImage);
                // File::delete(public_path().'/uploads/user/'.$oldImage);

            }
            session()->flash('success','User updated successfully.');
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destory ($id){
        $user = User::find($id);
        if($user == null){
            $message = 'User not found.';
            session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }
        File::delete(public_path().'/uploads/user/thumb/'.$user->image);
        File::delete(public_path().'/uploads/user/'.$user->image);
        $user->delete();
        $message = 'User deleted successfully.';
        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}
