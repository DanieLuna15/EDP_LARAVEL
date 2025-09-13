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
        Schema::table('venta_detalle_pps', function (Blueprint $table) {
            $table->string('hora')->nullable();
            $table->integer('cinta_cliente_id')->default(1);
            $table->integer('cliente_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venta_detalle_pps', function (Blueprint $table) {
            $table->dropColumn('hora');
            $table->dropColumn('cinta_cliente_id');
            $table->dropColumn('cliente_id');
        });
    }
};
