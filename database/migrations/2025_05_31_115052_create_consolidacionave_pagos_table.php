<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidacionavePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidacionave_pagos', function (Blueprint $table) {
            $table->id(); // Este es el campo 'id', auto incremental
            $table->integer('banco_id')->default(1); // Campo 'banco_id', con valor por defecto
            $table->integer('formapago_id')->default(1); // Campo 'formapago_id', con valor por defecto
            $table->decimal('suma_total', 10, 3)->default(0.000); // Campo 'suma_total', con tipo decimal
            $table->decimal('adelanto', 10, 3)->default(0.000); // Campo 'adelanto', con tipo decimal
            $table->date('fecha_limite')->nullable(); // Campo 'fecha_limite', que puede ser nulo
            $table->integer('tipo')->default(1); // Campo 'tipo', con valor por defecto
            $table->integer('estado')->default(1); // Campo 'estado', con valor por defecto
            $table->timestamps(); // Campos 'created_at' y 'updated_at' automáticamente gestionados por Eloquent
            $table->integer('user_id')->default(1); // Campo 'user_id', con valor por defecto
            $table->integer('sucursal_id')->default(1); // Campo 'sucursal_id', con valor por defecto
            $table->text('observaciones')->nullable(); // Campo 'observaciones', nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidacionave_pagos'); // Elimina la tabla si se revierte la migración
    }
}
