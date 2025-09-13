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
        Schema::create('pp_envio_transformacions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora')->nullable();
            $table->integer('sucursal_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('pp_id')->nullable();
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
        Schema::dropIfExists('pp_envio_transformacions');
    }
};
