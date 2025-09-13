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
        Schema::create('compra_inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('compra_id')->default(1);
            $table->integer('inventario_id')->default(1);
            $table->integer('medida_producto_id')->default(1);
            $table->integer('sub_medida_id')->default(1);
            $table->integer('categoria_id')->default(1);
            $table->decimal('cant',8,3)->default(0);
            $table->integer('nro')->default(0);
            $table->decimal('valor',8,3)->default(0);
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
        Schema::dropIfExists('compra_inventarios');
    }
};
