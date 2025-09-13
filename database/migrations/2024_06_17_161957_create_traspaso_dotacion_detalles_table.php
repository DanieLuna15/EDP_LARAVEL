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
        Schema::create('traspaso_dotacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('stockdotaciondetail_id')->default(1);
            $table->integer('traspaso_dotacion_id')->default(1);
            $table->decimal('cantidad',8,2)->default(1);
            $table->decimal('costo',8,2)->default(1);
            $table->decimal('venta',8,2)->default(1);
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
        Schema::dropIfExists('traspaso_dotacion_detalles');
    }
};
