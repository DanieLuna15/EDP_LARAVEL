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
        Schema::create('proveedor_compra_medidas', function (Blueprint $table) {
            $table->id();
            $table->integer('proveedor_compra_id')->default(1);
            $table->integer('sub_medida_id')->default(1);
            $table->integer('medida_producto_id')->default(1);

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
        Schema::dropIfExists('proveedor_compra_medidas');
    }
};
