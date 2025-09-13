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
        Schema::create('detalle_pps', function (Blueprint $table) {
            $table->id();
            $table->integer('pp_id')->default(1);
            $table->integer('lote_id')->default(1);
            $table->integer('lote_detalle_id')->default(1);
            $table->integer('lote_detalle_movimiento_id')->default(1);
            $table->integer('cajas')->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('peso_total', 8, 2)->default(0);
            $table->decimal('peso_neto', 8, 2)->default(0);
            $table->decimal('peso_bruto', 8, 2)->default(0);
            $table->decimal('merma_bruta', 8, 2)->default(0);
            $table->decimal('merma_neta', 8, 2)->default(0);
            $table->string('fecha')->nullable();
            $table->integer('descomponer')->default(1);
            $table->integer('estado')->default(1);
            $table->integer('back')->default(1);
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
        Schema::dropIfExists('detalle_pps');
    }
};
