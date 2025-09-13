<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_pt_transformacion_lotes', function (Blueprint $table) {
            $table->dateTime('cierre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_pt_transformacion_lotes', function (Blueprint $table) {
            $table->dropColumn('cierre');
        });
    }
};
