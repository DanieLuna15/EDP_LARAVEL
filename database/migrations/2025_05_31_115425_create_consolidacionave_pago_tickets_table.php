<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidacionavePagoTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidacionave_pago_tickets', function (Blueprint $table) {
            $table->id(); // Este es el campo 'id', auto incremental
            $table->unsignedBigInteger('consolidacion_pago_id')->default(1); // Campo 'consolidacion_pago_id', con valor por defecto
            $table->decimal('total', 10, 3)->default(0.000); // Campo 'total', con valor por defecto
            $table->decimal('monto', 10, 3)->default(0.000); // Campo 'monto', con valor por defecto
            $table->decimal('pendiente', 10, 3)->default(0.000); // Campo 'pendiente', con valor por defecto
            $table->decimal('deuda', 10, 3)->default(0.000); // Campo 'deuda', con valor por defecto
            $table->integer('banco_id')->default(1); // Campo 'banco_id', con valor por defecto
            $table->integer('estado')->default(1); // Campo 'estado', con valor por defecto
            $table->timestamps(); // Campos 'created_at' y 'updated_at' automáticamente gestionados por Eloquent
            $table->integer('formapago_id')->default(1); // Campo 'formapago_id', con valor por defecto
            $table->text('observaciones')->nullable(); // Campo 'observaciones' que puede ser NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidacionave_pago_tickets'); // Elimina la tabla si se revierte la migración
    }
}
