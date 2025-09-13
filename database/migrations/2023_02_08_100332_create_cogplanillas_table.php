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
        Schema::create('cogplanillas', function (Blueprint $table) {
            $table->id();
            $table->integer('dias_base')->default(1);
            $table->integer('atraso')->default(1);
            $table->integer('multiplicar')->default(1);
            $table->decimal('sueldo_base',8,2)->default(1);
            $table->integer('dividir_dia')->default(1);
            $table->integer('dividir_hora')->default(1);
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
        Schema::dropIfExists('cogplanillas');
    }
};
