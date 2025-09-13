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
        Schema::create('informe_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('informe_preliminar_id')->default(1);
            $table->integer('compo_externa_id')->default(1);
            $table->decimal('cupo',8,2)->default(0);
            $table->decimal('cupo_dia',8,2)->default(0);
            $table->decimal('cupo_fit',8,2)->default(0);
            $table->decimal('peso',8,2)->default(0);
            $table->decimal('total_cupo_fit',8,2)->default(0);
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
        Schema::dropIfExists('informe_detalles');
    }
};
