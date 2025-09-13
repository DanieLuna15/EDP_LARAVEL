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
        Schema::create('envio_gen_pp_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('envio_gen_pp_id')->default(1);
            $table->integer('detalle_pp_id')->default(1);         
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
        Schema::dropIfExists('envio_gen_pp_detalles');
    }
};
