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
        Schema::create('lote_detalle_movimientos', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('tipo')->default(1);
            $table->decimal('cajas',8,2)->default(0);
            $table->decimal('peso_bruto',8,2)->default(0);
            $table->decimal('peso_neto',8,2)->default(0);
            $table->integer('cantidad')->default(0);
            $table->decimal('peso',8,2)->default(0);
            $table->integer('lote_detalle_id')->default(1);
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
        Schema::dropIfExists('lote_detalle_movimientos');
    }
};
