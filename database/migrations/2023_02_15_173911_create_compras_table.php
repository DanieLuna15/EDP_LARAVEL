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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->date('fecha')->nullable();
            $table->text('hora')->nullable();
            $table->text('chofer')->nullable();
            $table->text('camion')->nullable();
            $table->text('placa')->nullable();
            $table->text('e_despacho')->nullable();
            $table->text('e_recepcion')->nullable();
            $table->decimal('sum_cant_pollos',8,3)->default(0);
            $table->decimal('sum_cant_envases',8,3)->default(0);
            $table->decimal('sum_peso_bruto',8,3)->default(0);
            $table->decimal('sum_peso_neto',8,3)->default(0);
            $table->decimal('sum_retraccion',8,3)->default(0);
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
        Schema::dropIfExists('compras');
    }
};
