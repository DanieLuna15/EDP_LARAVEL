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
        Schema::create('lote_detalles', function (Blueprint $table) {
            $table->id();
            $table->decimal('cajas',8,2)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('equivalente',8,2)->default(0);
            $table->text('name')->nullable();
            $table->decimal('peso_total',8,2)->default(0);
            $table->integer('lote_id')->default(1);
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
        Schema::dropIfExists('lote_detalles');
    }
};
