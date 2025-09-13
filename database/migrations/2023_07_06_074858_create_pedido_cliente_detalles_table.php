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
        Schema::create('pedido_cliente_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('pedido_cliente_id')->default(1);
            $table->integer('item_id')->default(1);
            $table->decimal('cajas', 8, 2)->default(0);
            $table->decimal('pollos', 8, 2)->default(0);
            $table->decimal('peso_bruto', 8, 2)->default(0);
            $table->decimal('peso_neto', 8, 2)->default(0);
            $table->decimal('tara', 8, 2)->default(0);
            $table->decimal('peso_neto_unitario', 8, 2)->default(0);
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
        Schema::dropIfExists('pedido_cliente_detalles');
    }
};
