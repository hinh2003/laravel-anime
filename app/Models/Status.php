<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $fillable = ['name_status', 'description'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'status_id');
    }
}
