<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArqueoVentaPagoGlobalTable extends Migration
{
    public function up()
    {
        Schema::create('arqueo_venta_pago_global', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pago_global_id');
            $table->unsignedBigInteger('arqueo_venta_id');
            $table->timestamps();

            $table->foreign('pago_global_id')->references('id')->on('pagos_globales')->onDelete('cascade');
            $table->foreign('arqueo_venta_id')->references('id')->on('arqueo_ventas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('arqueo_venta_pago_global');
    }
}