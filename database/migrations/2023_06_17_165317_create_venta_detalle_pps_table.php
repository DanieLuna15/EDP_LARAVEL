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
        Schema::create('venta_detalle_pps', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->decimal('cajas', 10, 2)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('peso_bruto', 10, 2)->default(0);
            $table->decimal('peso_neto', 10, 2)->default(0);
            $table->integer('pp_id')->default(1);
            $table->integer('venta_id')->default(1);
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
        Schema::dropIfExists('venta_detalle_pps');
    }
};
