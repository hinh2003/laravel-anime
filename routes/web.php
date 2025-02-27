<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Clients\LoginController;
use App\Http\Controllers\Clients\RegisterController;
use App\Http\Controllers\Clients\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SessionController ;
use \App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\MoviesController;
use App\Http\Controllers\Clients\MovieControlleer;
use App\Http\Controllers\LivemoviesController ;
use App\Http\Controllers\Clients\ChapMovieController ;
use App\Http\Controllers\Clients\UserController;
use App\Http\Controllers\Admin\ChapMoviesController ;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route:: prefix('admin')->group(function () {
    Route::get('/',[SessionController::class,'index']);
    Route::get('login',[SessionController::class,'index'])->name('login');
    Route::post('/login/store',[SessionController::class,'store']);
    Route::get('logout',[SessionController::class,'Logout'])->name('logout');

    Route::middleware(['auth','CheckRole'])->prefix('action')->group(function () {

    Route::get('main',[HomeAdminController::class,'index'])->name('main');

    Route::get('movies/add',[MoviesController::class,'index'])->name('movies.add');
    Route::post('movies/add/store', [MoviesController::class,'handAddMoive'])->name('movies.add.store');

    Route::get('movies/category', [MoviesController::class, 'addCategory'])->name('movies.category');
    Route::post('movies/category/store', [MoviesController::class, 'handCategory'])->name('movies.category.store');

    Route::get('movies/update/{id}', [MoviesController::class, 'updateMovie'])->name('movies.edit');
    Route::post('movies/update/{id}', [MoviesController::class, 'handUpdateMovie'])->name('movies.update');

        //Sua tap
    Route::get('movies/updateChap/{id}', [ChapMoviesController::class, 'updateChapMovie'])->name('chapmovies.edit');
    Route::put('movies/updateChap/store/{id}', [ChapMoviesController::class, 'handupdateChapMovie'])->name('chapmovies.update');
    Route::Delete('movies/deleteChap/{id}', [ChapMoviesController::class, 'deleteChapMovie'])->name('chapmovies.delete');


    Route::Delete('movies/delete/{id}', [MoviesController::class, 'handDelete'])->name('movies.delete');

    Route::get('account', [AccountController::class, 'index'])->name('account.index');
    Route::get('account/edit/{id}', [AccountController::class, 'accUpdate'])->name('account.edit');
    Route::post('account/update/{id}', [AccountController::class, 'handAccUpdate'])->name('account.update');

    Route::delete('account/delete/{id}', [AccountController::class, 'handDelete'])->name('account.delete');

//them tap phim
    Route::get('movies/addchap',[ChapMoviesController::class,'addChap'])->name('movies.addchap');
    Route::post('movies/addchap/store',[ChapMoviesController::class,'handAddChap'])->name('movies.addchap.store');

    // tìm kiếm phim
    Route::get('/movies/search', [MoviesController::class, 'search'])->name('movies.search');
    Route::resource('banners', BannerController::class);


    });


});

//client

Route::get('/list/{id}', [HomeController::class, 'showlist'])->name('list');
Route::get('/list/contry/{id}', [HomeController::class, 'showlistContry'])->name('list.contry');
Route::get('/list/status/{id}', [HomeController::class, 'showlistByStatus'])->name('listByStatus');
Route::get('/list/country/{id}', [HomeController::class, 'showlistByCountry'])->name('listByCountry');

//dang nhap

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login/store',[LoginController::class,'store'])->name('login.store');

//Dang Ky
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register/store',[RegisterController::class,'register'])->name('register.store');

//Dang xuat
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
//Phim info
Route::get('movies/{identifier}',[MovieControlleer::class,'index'])->name('movies.info');
//likeand unlike

Route::post('/movies/{movie}/like', [LivemoviesController::class, 'likeMovie'])->middleware('auth');
Route::post('/movies/{movie}/unlike', [LivemoviesController::class, 'unlikeMovie'])->middleware('auth');
//xem phim

Route::get('/movies/watch/{movie}', [ChapMovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{movie}/chapters/{chapter}', [ChapMovieController::class, 'showChapter'])->name('movies.chapter');
//timkiem

Route::get('/search', [SearchController::class, 'search'])->name('search');

//thong tin nguoi dung
Route::get('/profile',[UserController::class,'index'])->name('profile');


