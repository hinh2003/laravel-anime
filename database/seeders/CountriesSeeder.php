<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            'name_country' => 'Nhật Bản',
            'description' => 'Đất nước hoa anh đào',
            'created_at' => now(),
            'updated_at' => now(),
        ]);;
        DB::table('countries')->insert([
            'name_country' => 'Trung Quốc',
            'description' => 'dsaasd',
            'created_at' => now(),
            'updated_at' => now(),
        ]);;
    }
}
