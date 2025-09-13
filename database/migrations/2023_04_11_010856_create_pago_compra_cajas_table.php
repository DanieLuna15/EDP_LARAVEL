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
        Schema::create('pago_compra_cajas', function (Blueprint $table) {
            $table->id();
            $table->integer('compra_caja_id')->default(1);
            $table->decimal('total',8,2)->default(0);
            $table->decimal('monto',8,2)->default(0);
            $table->decimal('pendiente',8,2)->default(0);
            $table->decimal('deuda',8,2)->default(0);
            $table->integer('banco_id')->default(1);
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
        Schema::dropIfExists('pago_compra_cajas');
    }
};
