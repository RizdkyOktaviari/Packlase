<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePendapatanHarianProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $funPendapatanHaria = "
      CREATE FUNCTION `pendapatanHarian`(
        `start` TIMESTAMP,
        `end` TIMESTAMP
      )
      RETURNS INT(11)
      RETURN (
        SELECT SUM(total) FROM transactions
        WHERE created_at BETWEEN start AND end
      )";

      DB::unprepared($funPendapatanHaria);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
