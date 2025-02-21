<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $movies = Movie::all();

        return view('admin.fages.main',compact('movies'));
    }
    public function AccountMannger(){
        return view('admin.fages.accountMannager');
    }
}
