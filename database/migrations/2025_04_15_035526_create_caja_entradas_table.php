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
        Schema::create('caja_entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->default(0);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('almacen_id')->default(1);
            $table->date('fecha')->nullable();
            $table->text('hora')->nullable();
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
        Schema::dropIfExists('caja_entradas');
    }
};
