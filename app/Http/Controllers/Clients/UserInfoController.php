<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    //
    public function index(){

        $user = Auth::user();
        $movies = $user->movies; // Sử dụng phương thức movies() đã định nghĩa trong User model

        return view('Client.userinfo',compact('movies'));
//        return dd($movies);
    }
}
