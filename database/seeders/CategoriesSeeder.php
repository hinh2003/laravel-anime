<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('categories')->insert([
            'name_category' => Str::random(10),
            'description' => Str::random(10)
        ]);
    }
}
