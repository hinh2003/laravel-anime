<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chap_movies extends Model
{
    use HasFactory;
    protected $fillable = ['name_chap', 'link_chap', 'movie_id', 'created_at', 'updated_at'];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
