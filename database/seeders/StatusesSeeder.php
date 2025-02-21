<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            'name_satus' => 'Hoàn Thành',
            'description' => 'Bộ phim đã hoàn thành',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('statuses')->insert([
            'name_satus' => 'Tiếp tục',
            'description' => 'Bộ phim đang dang dở',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
