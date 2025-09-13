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
        Schema::table('pp_detalles', function (Blueprint $table) {
            $table->integer('lote_detalle_movimiento_id')->default(1);
            $table->decimal('peso_bruto', 8, 2)->default(0);
            $table->decimal('merma_bruta', 8, 2)->default(0);
            $table->decimal('merma_neta', 8, 2)->default(0);
            $table->integer('cajas')->default(0);
            $table->integer('back')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pp_detalles', function (Blueprint $table) {
            $table->dropColumn('lote_detalle_movimiento_id');
            $table->dropColumn('peso_bruto');
            $table->dropColumn('merma_bruta');
            $table->dropColumn('merma_neta');
            $table->dropColumn('cajas');
            $table->dropColumn('back');
        });
    }
};
