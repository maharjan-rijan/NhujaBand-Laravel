<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use Carbon\Carbon;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $totalUsers = User::where('role',1)->count();
        $date = Carbon::now();
        return view('admin.dashboard',[
            'totalUsers' => $totalUsers,
            'date' => $date->format('Y/m/d'),
            'time' => $date->format('H:m A'),
            'day' => $date->format('l')
        ]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
