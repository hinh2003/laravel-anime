<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveMovies extends Model
{
    protected $table = 'like_movies';
    protected $fillable = ['movie_id','user_id'];

    public function movie(){
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
