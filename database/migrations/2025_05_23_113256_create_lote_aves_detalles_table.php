<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lote_aves_detalles', function (Blueprint $table) {
            $table->id();

            $table->decimal('cajas', 10, 3)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('equivalente', 10, 3)->default(0);
            $table->text('name')->nullable();
            $table->decimal('peso_total', 10, 3)->default(0);

            $table->unsignedBigInteger('lote_id')->default(1);
            $table->integer('estado')->default(1);

            $table->unsignedBigInteger('categoria_id')->default(1);
            $table->unsignedBigInteger('medida_producto_id')->default(1);
            $table->unsignedBigInteger('sub_medida_id')->default(1);
            $table->integer('pigmento')->default(0);

            $table->unsignedBigInteger('compra_ave_id')->default(1); 
            $table->string('producto')->nullable();
            $table->string('fecha')->nullable();
            $table->text('hora')->nullable();
            $table->string('tipo')->nullable();
            $table->string('nro')->nullable();
            $table->string('id_nro')->nullable();
            $table->string('detalle')->nullable();

            $table->unsignedBigInteger('user_id')->default(1);
            $table->unsignedBigInteger('compra_inventario_id')->default(1);
            $table->integer('tipo_producto')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lote_aves_detalles');
    }
};
