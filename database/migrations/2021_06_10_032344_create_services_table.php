<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\ServiceSeeder;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
          $table->id();
          $table->string('name', 100)->nullable();
          $table->foreignId('jenisservice_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
          $table->text('description')->nullable();
          $table->integer('price')->nullable();
          $table->softDeletes();
          $table->timestamps();
        });

        $seed = new ServiceSeeder;
        $seed->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
