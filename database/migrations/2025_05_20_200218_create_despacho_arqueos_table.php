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
        Schema::create('despacho_arqueos', function (Blueprint $table) {
            $table->id();
            $table->integer('venta_id')->default(1);
            $table->integer('arqueo_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('forma_pago_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->decimal('monto', 10, 2)->default(0);
            $table->decimal('paga_con', 10, 2)->default(0);
            $table->decimal('cambio', 10, 2)->default(0);
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
        Schema::dropIfExists('despacho_arqueos');
    }
};
