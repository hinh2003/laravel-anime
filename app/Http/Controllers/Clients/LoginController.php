<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('pages.login');
    }
    public function store(Request $request){
        if(Auth::attempt([
            'name' => $request['name'],
            'password' => $request['password']

        ]))
        {
            $request->session()->put('username', $request->input('name'));

            return redirect()->route('home');
        }
        else{
            $request->session()->flash('error', 'Email hoặc mật khẩu không đúng');
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        $request->session()->forget('username'); // Xóa session username
        Auth::logout();
        return redirect('/');
    }
}
