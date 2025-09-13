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
        Schema::create('sucursal_tirajes', function (Blueprint $table) {
            $table->id();
            $table->text('serie')->nullable();
            $table->text('nro_auth')->nullable();
            $table->integer('comprobante_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('inicio')->default(1);
            $table->integer('fin')->default(1);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
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
        Schema::dropIfExists('sucursal_tirajes');
    }
};
