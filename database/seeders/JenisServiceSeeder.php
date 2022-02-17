<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class JenisServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('jenisservices')->insert([
        'id' => 1,
        'jenis' => 'Laundry-in Aja!',
        'slug' => Str::slug('Laundry-in aja'),
        'rate' => '0',
        'description' => 'layanan laundry mulai dari cuci sampai setrika dengan beberapa penawaran paket',
        'picturePath' => '/img/services/laundry.png',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('jenisservices')->insert([
        'id' => 2,
        'jenis' => 'Bersihin Yuk!',
        'slug' => Str::slug('Bersihin Yuk'),
        'rate' => '0',
        'description' => 'Layanan pembersihan umum ruangan secara menyeluruh serta profesional meliputi mengelap debu, mengepel lantai, merapikan kamar tidur/barang, dan membersihkan kamar mandi',
        'picturePath' => '/img/services/bersih.png',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('jenisservices')->insert([
        'id' => 3,
        'jenis' => 'Paketin Yuk!',
        'slug' => Str::slug('Paketin Yuk'),
        'rate' => '0',
        'description' => 'Layanan paket barang pelanggan, bekerja sama dengan jasa pengiriman seperti JNE, JNT, POS dan lain sebagainya. Pelanggan dapat memilih sendiri jasa pengiriman sesuai minat',
        'picturePath' => '/img/services/paket.png',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);

      DB::table('jenisservices')->insert([
        'id' => 4,
        'jenis' => 'Titipin Sini Aja!',
        'slug' => Str::slug('Titipin Sini Aja'),
        'rate' => '0',
        'description' => 'Layanan penitipan barang seperti buku, baju, perabotan, dsb. Dalam layanan kami, keamanan dan kondisi barang pelanggan sangat terjamin karena kami beorientasi pada kepuasan pelanggan',
        'picturePath' => '/img/services/titip.png',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
      ]);
    }
}
