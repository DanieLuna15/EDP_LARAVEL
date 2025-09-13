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
        Schema::create('bitacora_lotes', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->integer('lote_id')->default(1);
            $table->date('fecha')->nullable();
            $table->decimal('peso_total', 10, 2);
            $table->decimal('peso_neto', 10, 2);
            $table->decimal('peso_bruto', 10, 2);
            $table->decimal('cajas', 10, 2);
            $table->decimal('cajas_lote', 10, 2);
            $table->decimal('pollos', 10, 2);
            $table->decimal('pollos_lote', 10, 2);
            $table->integer('tipo')->default(1);
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
        Schema::dropIfExists('bitacora_lotes');
    }
};
