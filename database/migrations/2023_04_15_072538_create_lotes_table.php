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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->integer('compra_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->decimal('precio_venta',8,2)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('valor_venta',8,2)->default(0);
            $table->decimal('valor_compra',8,2)->default(0);
            $table->decimal('cajas',8,2)->default(0);
            $table->decimal('valor_peso',8,2)->default(0);
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('lotes');
    }
};
