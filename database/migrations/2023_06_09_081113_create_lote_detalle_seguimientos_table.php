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
        Schema::create('lote_detalle_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->text('nro')->nullable();
            $table->text('cliente')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('lote_detalle_id')->default(1);
            $table->decimal('peso_bruto',8,2)->default(0);
            $table->decimal('tara',8,2)->default(0);
            $table->decimal('peso_neto',8,2)->default(0);
            $table->decimal('cont_e',8,2)->default(0);
            $table->decimal('cont_s',8,2)->default(0);
            $table->decimal('cont_sa',8,2)->default(0);
            $table->decimal('unit_e',8,2)->default(0);
            $table->decimal('unit_s',8,2)->default(0);
            $table->decimal('unit_sa',8,2)->default(0);
            $table->decimal('kgs_e',8,2)->default(0);
            $table->decimal('kgs_s',8,2)->default(0);
            $table->decimal('kgs_sa',8,2)->default(0);
          
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
        Schema::dropIfExists('lote_detalle_seguimientos');
    }
};
