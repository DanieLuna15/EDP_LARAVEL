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
        Schema::table('pp_traspaso_pps', function (Blueprint $table) {
            $table->integer('cinta_cliente_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pp_traspaso_pps', function (Blueprint $table) {
            $table->dropColumn('cinta_cliente_id');
        });
    }
};
