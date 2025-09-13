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
        Schema::create('salidadotaclientes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->integer('cliente_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
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
        Schema::dropIfExists('salidadotaclientes');
    }
};
