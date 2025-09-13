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
        Schema::create('transformacion_lote_detalles', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora')->nullable();
            $table->integer('pp_envio_transformacion_detalle_id')->nullable();
            $table->integer('transformacion_lote_id')->nullable();
            $table->integer('cajas')->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('peso_bruto',8,3)->default(0);
            $table->decimal('peso_neto',8,3)->default(0);
            $table->decimal('peso_bruto_u',8,3)->default(0);
            $table->decimal('peso_neto_u',8,3)->default(0);
            $table->decimal('merma_bruto',8,3)->default(0);
            $table->decimal('merma_neto',8,3)->default(0);
            $table->integer('sucursal_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('transformacion_lote_detalles');
    }
};
