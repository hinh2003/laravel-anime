<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('users')->insert([

            'name' => 'NguyenVanHinh',
            'email' => 'vanhinh2003123@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // Thay 'password' bằng mật khẩu mong muốn
            'role_id' => 1, // Đặt role_id cho người dùng mặc định
            'created_at' => now(),
            'updated_at' => now(),
        ]);
//        DB::table('users')->insert([
//            'id' => 2,
//            'name' => 'hinh2003',
//            'email' => 'vanhinh20031@gmail.com',
//            'email_verified_at' => now(),
//            'password' => Hash::make('123456'), // Thay 'password' bằng mật khẩu mong muốn
//            'role_id' => 2, // Đặt role_id cho người dùng mặc định
//            'created_at' => now(),
//            'updated_at' => now(),
//        ]);
    }
}
