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
        Schema::create('enviar_item_pt_transformacions', function (Blueprint $table) {
            $table->id();
            $table->integer('pt_id')->default(1);
            $table->integer('item_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->dateTime('fecha_hora')->nullable();
            $table->decimal('peso_bruto', 8, 3)->default(0);
            $table->decimal('peso_neto', 8, 3)->default(0);
            $table->integer('cajas')->default(0);
            $table->integer('is_aceptado')->default(0);
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
        Schema::dropIfExists('enviar_item_pt_transformacions');
    }
};
