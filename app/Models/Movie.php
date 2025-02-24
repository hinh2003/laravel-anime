<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name_movie', 'pic', 'years', 'description', 'category_id', 'country_id', 'status_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_movies', 'movie_id', 'category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public  function users()
    {
        return $this->belongsToMany(User::class, 'like_movies', 'movie_id', 'user_id');
    }
    public function Chap_movies(){
        return $this->hasMany(Chap_movies::class, 'movie_id');
    }
    public static function findMovie($id)
    {
        return self::find($id);
    }

}
