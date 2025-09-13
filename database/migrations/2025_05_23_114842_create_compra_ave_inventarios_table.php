<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('compra_ave_inventarios', function (Blueprint $table) {
            $table->id(); 

            $table->unsignedBigInteger('compra_ave_id')->default(1);
            $table->unsignedBigInteger('inventario_id')->default(1);  
            $table->unsignedBigInteger('medida_producto_id')->default(1);
            $table->unsignedBigInteger('sub_medida_id')->default(1);
            $table->unsignedBigInteger('categoria_id')->default(1);

            $table->decimal('cant', 8, 3)->default(0);
            $table->integer('nro')->nullable();

            $table->decimal('valor', 8, 3)->default(0);
            $table->integer('estado')->default(1);

            $table->integer('cinta')->default(1);
            $table->unsignedBigInteger('sub_original_id')->default(1);
            $table->integer('pigmento')->default(1);
            $table->integer('tipo_pollo')->default(1);
            $table->integer('editado')->default(0);

            $table->string('name')->nullable();
            $table->string('name_producto')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compra_ave_inventarios');
    }
};
