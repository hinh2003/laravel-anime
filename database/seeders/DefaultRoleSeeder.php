<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 2,
                'name_role' => 'Admin',
                'description_role' => 'Administrator role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 1,
                'name_role' => 'User',
                'description_role' => 'Regular user role',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
