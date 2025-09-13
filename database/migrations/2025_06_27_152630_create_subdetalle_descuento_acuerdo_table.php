<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdetalleDescuentoAcuerdoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subdetalle_descuento_acuerdo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_detalle_pp_id')->nullable(); // id del detalle pp
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_nombre')->nullable();
            $table->unsignedBigInteger('acuerdo_id')->nullable();
            $table->string('acuerdo_nombre')->nullable();
            $table->decimal('peso', 10, 3)->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('descuento_valor', 10, 2)->nullable();
            $table->decimal('total_con_descuento', 10, 2)->nullable();
            $table->decimal('total_sin_descuento', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('subdetalle_descuento_acuerdo');
    }
}
