<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    DB::table('ratings')->insert([

      'user_id' => '1',
      'jenisservice_id' => 1,
      'rate' => '5',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);

    DB::table('ratings')->insert([

      'user_id' => '2',
      'jenisservice_id' => 2,
      'rate' => '5',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);

    DB::table('ratings')->insert([

      'user_id' => '3',
      'jenisservice_id' => 3,
      'rate' => '5',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);

    DB::table('ratings')->insert([

      'user_id' => '3',
      'jenisservice_id' => 4,
      'rate' => '5',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);

    }
}
