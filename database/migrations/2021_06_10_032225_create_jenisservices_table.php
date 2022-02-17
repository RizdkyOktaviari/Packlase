<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\JenisServiceSeeder;

class CreateJenisservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenisservices', function (Blueprint $table) {
          $table->id();
          $table->string('jenis', 25);
          $table->string('slug', 50);
          $table->double('rate')->nullable();
          $table->text('description')->nullable();
          $table->string('picturePath')->nullable();
          $table->timestamps();
        });

        $seed = new JenisServiceSeeder;
        $seed->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenisservices');
    }
}
