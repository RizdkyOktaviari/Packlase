<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('services')->insert([
        'id' => 1,
        'name' => 'Laundry Cuci Sampai Dengan Setrika',
        'jenisservice_id' => 1,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 6000,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('services')->insert([
        'id' => 2,
        'name' => 'Laundry Cuci Sampai Dengan Kering',
        'jenisservice_id' => 1,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 4000,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('services')->insert([
        'id' => 3,
        'name' => 'Layanan Bersih – Bersih',
        'jenisservice_id' => 2,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 50000,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('services')->insert([
        'id' => 4,
        'name' => 'Layanan Paketin Yuk!',
        'jenisservice_id' => 3,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 50000,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('services')->insert([
        'id' => 5,
        'name' => 'Titip per BOX',
        'jenisservice_id' => 4,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 80000,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('services')->insert([
        'id' => 6,
        'name' => 'Titip Motor Harian',
        'jenisservice_id' => 4,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 7500,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('services')->insert([
        'id' => 7,
        'name' => 'Titip Motor Bulanan',
        'jenisservice_id' => 4,
        'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
        'price' => 200000,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);
    }
}
