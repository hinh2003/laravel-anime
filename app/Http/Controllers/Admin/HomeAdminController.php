<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function index(){
        $movies = Movie::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.fages.main',compact('movies'));
    }
    public function AccountMannger(){
        return view('admin.fages.accountMannager');
    }


}
