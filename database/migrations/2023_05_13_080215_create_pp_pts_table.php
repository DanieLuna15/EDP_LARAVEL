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
        Schema::create('pp_pts', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->default(0);
            $table->integer('pp_detalle_id')->default(1);
            $table->integer('pt_detalle_id')->default(1);
            $table->string('fecha');
            $table->string('hora');
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
        Schema::dropIfExists('pp_pts');
    }
};
