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
        Schema::create('venta_transformacions', function (Blueprint $table) {
            $table->id();
            $table->integer('venta_id')->default(1);
            $table->integer('transformacion_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('subitem_id')->default(1);
            $table->integer('pt_id')->default(1);
            $table->integer('cajas')->default(0);
            $table->decimal('venta', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->decimal('peso_bruto', 8, 3)->default(0);
            $table->decimal('peso_neto', 8, 3)->default(0);
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
        Schema::dropIfExists('venta_transformacions');
    }
};
