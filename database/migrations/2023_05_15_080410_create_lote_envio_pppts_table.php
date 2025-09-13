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
        Schema::create('lote_envio_pppts', function (Blueprint $table) {
            $table->id();
            $table->integer('lote_id')->default(1);
            $table->integer('pp_detalle_id')->default(1);
            $table->integer('pt_detalle_id')->default(1);
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
        Schema::dropIfExists('lote_envio_pppts');
    }
};
