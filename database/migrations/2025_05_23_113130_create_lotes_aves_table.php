<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lotes_aves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_ave_id')->default(1);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->decimal('precio_venta', 10, 3)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('valor_venta', 10, 3)->default(0);
            $table->decimal('valor_compra', 10, 3)->default(0);
            $table->decimal('cajas', 10, 3)->default(0);
            $table->decimal('valor_peso', 10, 3)->default(0);
            $table->date('fecha')->nullable();
            $table->integer('estado')->default(1);
            $table->integer('fin')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lotes_aves');
    }
};
