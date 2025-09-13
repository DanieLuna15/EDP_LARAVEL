<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ave_inventarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id')->default(1);
            $table->unsignedBigInteger('sucursal_id')->default(1);
            $table->unsignedBigInteger('almacen_id')->default(1);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->unsignedBigInteger('lote_id')->default(1);
            $table->text('motivo')->nullable();
            $table->unsignedBigInteger('medida_producto_id')->default(1);
            $table->unsignedBigInteger('sub_medida_id')->default(1);
            $table->decimal('cant', 8, 3)->default(0);
            $table->decimal('nro', 8, 3)->default(0);
            $table->integer('estado')->default(1);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ave_inventarios');
    }
};
