<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index(){
        $users = User::with('role')->get();

        return view('admin.fages.account', compact('users'));
    }
    public function accUpdate($id){
        $users = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.fages.updateAccout',compact('users','roles'));
    }
    public function handAccUpdate(Request $request, $id){

        $user = User::findOrFail($id);

        $user->name = $request->input('tendangnhap');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->role_id = $request->input('ten_quyen');
        $user->save();

        return redirect()->route('account.index')->with('success', 'Cập nhật thành công!');
    }
    public function handDelete($id){
        $user = User::find($id);
        // Xóa bản ghi phim
        $user->delete();

        return redirect()->route('account.index')->with('success', 'Accout đã được xóa thành công');
    }
}
