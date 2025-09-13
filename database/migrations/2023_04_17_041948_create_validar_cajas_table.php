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
        Schema::create('validar_cajas', function (Blueprint $table) {
            $table->id();
            $table->text('motivo')->nullable();
           
            $table->integer('compra_id')->default(1);
        
            $table->integer('destino_id')->default(1);
            $table->integer('origen_id')->default(1);
            $table->integer('estado')->default(1);
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('validar_cajas');
    }
};
