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
        Schema::create('sub_item_pt_transformacion_lotes', function (Blueprint $table) {
            $table->id();
            $table->text('encargado')->nullable();
            $table->integer('item_pt_transformacion_lote_id')->default(1);
            $table->integer('transformacion_lote_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('item_id')->default(1);
            $table->integer('subitem_id')->default(1);
            $table->integer('pt_id')->default(1);
            $table->integer('cajas')->default(0);
            $table->decimal('peso_bruto', 8, 3)->default(0);
            $table->decimal('peso_neto', 8, 3)->default(0);
            $table->dateTime('fecha_hora')->nullable();
            $table->integer('is_declarado')->default(0);
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
        Schema::dropIfExists('sub_item_pt_transformacion_lotes');
    }
};
