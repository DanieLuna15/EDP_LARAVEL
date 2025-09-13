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
        Schema::create('pedido_clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('sucursal_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('cliente_id')->default(1);
            $table->integer('chofer_id')->default(1);
            $table->integer('formapago_id')->default(1);
            $table->integer('tipo')->default(1);
            $table->date('fecha_entrega')->nullable();
            $table->date('fecha')->nullable();
            $table->text('hora_entrega')->nullable();
            $table->text('tiempo')->nullable();
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
        Schema::dropIfExists('pedido_clientes');
    }
};
