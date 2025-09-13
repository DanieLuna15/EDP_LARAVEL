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
        Schema::create('consolidacionavenew_pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('banco_id')->default(1); 
            $table->integer('formapago_id')->default(1); 
            $table->decimal('suma_total', 10, 2)->default(0.00); 
            $table->decimal('adelanto', 10, 2)->default(0.00); 
            $table->date('fecha_limite')->nullable(); 
            $table->integer('tipo')->default(1); 
            $table->integer('estado')->default(1); 
            $table->timestamps(); 
            $table->integer('user_id')->default(1); 
            $table->integer('sucursal_id')->default(1); 
            $table->text('observaciones')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidacionavenew_pagos');
    }
};
