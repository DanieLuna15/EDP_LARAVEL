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
        Schema::create('lote_detalle_historials', function (Blueprint $table) {
            $table->id();
            $table->integer('lote_detalle_id')->default(1);
            $table->integer('lote_detalle_venta_id')->default(1);
            $table->integer('lote_detalle_producto_id')->default(1);
            $table->integer('lote_detalle_cliente_id')->default(1);
            $table->integer('lote_detalle_seguimiento_id')->default(1);
            $table->integer('lote_detalle_movimiento_id')->default(1);
            $table->integer('lote_detalle_compra_id')->default(1);
            $table->integer('venta_id')->default(1);
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('lote_detalle_historials');
    }
};
