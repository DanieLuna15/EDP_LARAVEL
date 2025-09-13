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
        Schema::create('lote_detalle_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('lote_id')->nullable();
            $table->integer('lote_detalle_id')->nullable();
            $table->string('producto')->nullable();
            $table->string('pigmento')->nullable();
            $table->string('fecha')->nullable();
            $table->string('tipo')->nullable();
            $table->string('nro')->nullable();
            $table->string('detalle')->nullable();
            $table->decimal('peso_bruto', 10, 2)->default(0);
            $table->decimal('tara', 10, 2)->default(0);
            $table->decimal('peso_neto', 10, 2)->default(0);
            $table->decimal('m1', 10, 2)->default(0);
            $table->decimal('m2', 10, 2)->default(0);
            $table->decimal('mermatotal', 10, 2)->default(0);
            $table->decimal('cajas_e', 10, 2)->default(0);
            $table->decimal('cajas_s', 10, 2)->default(0);
            $table->decimal('cajas_sa', 10, 2)->default(0);
            $table->decimal('und_e', 10, 2)->default(0);
            $table->decimal('und_s', 10, 2)->default(0);
            $table->decimal('und_sa', 10, 2)->default(0);
            $table->decimal('kg_e', 10, 2)->default(0);
            $table->decimal('kg_s', 10, 2)->default(0);
            $table->decimal('kg_sa', 10, 2)->default(0);
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
        Schema::dropIfExists('lote_detalle_productos');
    }
};
