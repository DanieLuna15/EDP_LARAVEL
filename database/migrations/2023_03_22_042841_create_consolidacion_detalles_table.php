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
        Schema::create('consolidacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('categoria_id')->default(1);
            $table->integer('consolidacion_id')->default(1);
            $table->decimal('suma_total',8,2)->default(0);
            $table->decimal('criterio',8,2)->default(0);
            $table->decimal('precio',8,2)->default(0);
            $table->decimal('nuevoajuste',8,2)->default(0);
            $table->decimal('ajuste',8,2)->default(0);
            $table->decimal('nuevo_peso',8,2)->default(0);
            $table->decimal('nuevo_peso_2',8,2)->default(0);
            $table->decimal('oficial',8,2)->default(0);
            $table->decimal('precio_compra',8,2)->default(0);
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
        Schema::dropIfExists('consolidacion_detalles');
    }
};
