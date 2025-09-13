<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidacionavePagoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidacionave_pago_detalles', function (Blueprint $table) {
            $table->id(); // Este es el campo 'id', auto incremental
            $table->integer('consolidacion_pago_id')->default(1); // Campo 'consolidacion_pago_id', con valor por defecto
            $table->integer('consolidacion_id')->default(1); // Campo 'consolidacion_id', con valor por defecto
            $table->integer('estado')->default(1); // Campo 'estado', con valor por defecto
            $table->timestamps(); // Campos 'created_at' y 'updated_at' automáticamente gestionados por Eloquent
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidacionave_pago_detalles'); // Elimina la tabla si se revierte la migración
    }
}
