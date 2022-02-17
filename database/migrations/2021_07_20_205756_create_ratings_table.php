<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\RatingSeeder;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('jenisservice_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->double('rate')->nullable();
            $table->timestamps();
        });

        $seed = new RatingSeeder;
        $seed->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
