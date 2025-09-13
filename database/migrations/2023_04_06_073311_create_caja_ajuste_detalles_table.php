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
        Schema::create('caja_ajuste_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('caja_ajuste_id')->default(1);
            $table->integer('caja_inventario_id')->default(1);
            $table->integer('stock_actual')->default(1);
            $table->integer('ajuste')->default(1);
            $table->integer('stock_final')->default(1);
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
        Schema::dropIfExists('caja_ajuste_detalles');
    }
};
