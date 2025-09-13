<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lote_detalle_compras_aves', function (Blueprint $table) {
            $table->id();

            $table->decimal('peso_bruto', 10, 3);
            $table->decimal('peso_neto', 10, 3);

            $table->unsignedBigInteger('lote_detalle_id')->default(1);
            $table->unsignedBigInteger('compra_ave_id')->default(1);

            $table->integer('estado')->default(1);
            $table->boolean('anulado')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lote_detalle_compras_aves');
    }
};
