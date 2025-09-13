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
        Schema::create('consolidacion_ave_detalles', function (Blueprint $table) {
            $table->id(); // id bigint unsigned primary key auto increment
            $table->integer('categoria_id')->default(1);
            $table->integer('consolidacion_id')->default(1);
            $table->decimal('suma_total', 10, 3)->default(0.000);
            $table->decimal('criterio', 10, 3)->default(0.000);
            $table->decimal('precio', 10, 3)->default(0.000);
            $table->decimal('nuevoajuste', 10, 3)->default(0.000);
            $table->decimal('ajuste', 10, 3)->default(0.000);
            $table->decimal('nuevo_peso', 10, 3)->default(0.000);
            $table->decimal('nuevo_peso_2', 10, 3)->default(0.000);
            $table->decimal('oficial', 10, 3)->default(0.000);
            $table->decimal('precio_compra', 10, 3)->default(0.000);
            $table->integer('estado')->default(1);
            $table->integer('compra_ave_id')->default(1);
            $table->decimal('lp', 10, 3)->default(0.000);
            $table->integer('pollos')->default(0);
            $table->decimal('kg_total', 10, 3)->default(0.000);
            $table->decimal('kg_criterio', 10, 3)->default(0.000);
            $table->decimal('kg_criterio_total', 10, 3)->default(0.000);            
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
        Schema::dropIfExists('consolidacion_ave_detalles');
    }
};
