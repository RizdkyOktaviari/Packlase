<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'superadmin',
        'address' => 'superadmin',
        'phoneNumber' => '021',
        'email' => 'superadmin@gmail.com',
        'roles' => 'superadmin',
        'password' => Hash::make('superadmin'),
        'profile_photo_path' => 'img/profile/undraw_profile.svg',
      ]);

      DB::table('users')->insert([
        'name' => 'admin',
        'address' => 'admin',
        'phoneNumber' => '021',
        'email' => 'admin@gmail.com',
        'roles' => 'admin',
        'password' => Hash::make('admin'),
        'profile_photo_path' => 'img/profile/undraw_profile.svg',
      ]);

      DB::table('users')->insert([
        'name' => 'user',
        'address' => 'user',
        'phoneNumber' => '021',
        'email' => 'user@gmail.com',
        'roles' => 'user',
        'password' => Hash::make('user'),
        'profile_photo_path' => 'img/profile/undraw_profile.svg',
      ]);
    }
}
