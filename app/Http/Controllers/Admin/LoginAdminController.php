<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User ;

class LoginAdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function store(Request $request){
        if(Auth::attempt([
            'name' => $request['tendangnhap'],
            'password' => $request['paswworddangnhap']

        ]))
        {
            return redirect()->route('main');
        }
        else{
            $request->session()->flash('error', 'Email hoặc mật khẩu không đúng');
            return redirect()->back();
        }

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect( )-> route('login');
    }
}
