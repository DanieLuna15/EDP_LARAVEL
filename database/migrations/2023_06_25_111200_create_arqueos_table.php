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
        Schema::create('arqueos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('caja_sucursal_usuario_id');
            $table->integer('user_id');
            $table->integer('sucursal_id');
            $table->decimal('monto_inicial', 10, 2);
            $table->integer('apertura')->default(1);
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
        Schema::dropIfExists('arqueos');
    }
};
