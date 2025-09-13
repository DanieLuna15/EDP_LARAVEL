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
        Schema::create('caja_inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo')->default(1);
            $table->text('motivo')->nullable();
            $table->integer('caja_id')->default(1);
            $table->integer('almacen_id')->default(1);
            $table->integer('cantidad')->default(1);
            $table->decimal('compra',8,2)->default(0);
            $table->decimal('venta',8,2)->default(0);
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
        Schema::dropIfExists('caja_inventarios');
    }
};
