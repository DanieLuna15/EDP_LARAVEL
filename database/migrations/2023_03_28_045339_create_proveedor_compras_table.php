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
        Schema::create('proveedor_compras', function (Blueprint $table) {
            $table->id();
            $table->text('nombre')->nullable();
            $table->integer('documento_id')->default(1);
            $table->text('doc')->nullable();
            $table->text('direccion')->nullable();
            $table->text('telefono')->nullable();
            $table->text('encargado')->nullable();
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
        Schema::dropIfExists('proveedor_compras');
    }
};
