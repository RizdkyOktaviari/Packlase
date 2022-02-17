<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        $table->foreignId('comment_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
        $table->text('komentar');
        $table->softDeletes();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
