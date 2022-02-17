<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
          $table->id();
          $table->foreignId('transaction_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
          $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
          $table->string('address', 200)->nullable();
          $table->string('address_detail', 50)->nullable();
          $table->string('origin', 150)->nullable();
          $table->string('destination', 150)->nullable();
          $table->smallInteger('weight')->nullable();
          $table->string('courier', 50)->nullable();
          $table->string('space', 15)->nullable();
          $table->date('start')->nullable();
          $table->date('end')->nullable();
          $table->string('extra', 15)->nullable();
          $table->string('voucher_code', 20)->nullable();
          $table->smallInteger('quantity')->nullable();
          $table->integer('subtotal');
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
        Schema::dropIfExists('detail_transactions');
    }
}
