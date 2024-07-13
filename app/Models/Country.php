<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name_country', 'description','created_at','updated_at'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'country_id');
    }
}
