<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User ;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
class RegisterController extends Controller
{
    //
    public function index(){
        return view('pages.register');
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 1, // Gán role_id mặc định, có thể thay đổi tùy theo yêu cầu của bạn
        ]);

        // Đăng nhập ngay sau khi đăng ký thành công (tuỳ chọn)
        // Auth::login($user);

        // Chuyển hướng người dùng sau khi đăng ký thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }
}
