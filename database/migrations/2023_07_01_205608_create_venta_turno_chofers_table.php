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
        Schema::create('venta_turno_chofers', function (Blueprint $table) {
            $table->id();
            $table->integer('turno_chofer_id')->default(1);
            $table->integer('venta_id')->default(1);
            $table->decimal('peso', 8, 2)->default(0);
            $table->date('fecha')->nullable();
            $table->integer('entregado')->default(1);
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
        Schema::dropIfExists('venta_turno_chofers');
    }
};
