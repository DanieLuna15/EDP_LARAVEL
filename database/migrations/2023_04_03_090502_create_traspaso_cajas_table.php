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
        Schema::create('traspaso_cajas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->integer('almacen_origen_id')->default(1);
            $table->integer('almacen_destino_id')->default(1);
            $table->integer('caja_id')->default(1);
            $table->text('motivo')->nullable();
            $table->integer('cantidad')->default(1);
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
        Schema::dropIfExists('traspaso_cajas');
    }
};
