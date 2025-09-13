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
        Schema::create('kardex_dotacions', function (Blueprint $table) {
            $table->id();
            $table->text('motivo')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('dotacion_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('movimiento')->default(1);
            $table->text('tipo')->nullable();
            $table->decimal('costo', 10, 2)->default(0);
            $table->decimal('venta', 10, 2)->default(0);
            $table->integer('entradas')->default(1);
            $table->integer('salidas')->default(1);
            $table->integer('stock')->default(1);
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
        Schema::dropIfExists('kardex_dotacions');
    }
};
