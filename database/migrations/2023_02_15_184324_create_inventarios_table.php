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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('almacen_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('lote_id')->default(1);
            $table->text('motivo')->nullable();
            $table->integer('medida_producto_id')->default(1);
            $table->integer('sub_medida_id')->default(1);
            $table->decimal('cant',8,3)->default(0);
            $table->decimal('nro',8,3)->default(0);
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
        Schema::dropIfExists('inventarios');
    }
};
