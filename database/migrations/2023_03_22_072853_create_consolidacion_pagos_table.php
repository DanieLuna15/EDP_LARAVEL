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
        Schema::create('consolidacion_pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('banco_id')->default(1);
            $table->decimal('suma_total',8,2)->default(0);
            $table->decimal('adelanto',8,2)->default(0);
            $table->integer('tipo')->default(1);
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
        Schema::dropIfExists('consolidacion_pagos');
    }
};
