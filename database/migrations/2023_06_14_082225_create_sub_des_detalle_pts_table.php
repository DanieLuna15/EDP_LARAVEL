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
        Schema::create('sub_des_detalle_pts', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('peso_total', 10, 2);
            $table->decimal('equivale', 10, 2);
            $table->integer('detalle_pt_descomposicion_id')->default(1);
            $table->integer('compo_externa_detalle_id')->default(1);
            $table->integer('detalle_pt_id')->default(1);
            $table->integer('trozado')->default(0);
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
        Schema::dropIfExists('sub_des_detalle_pts');
    }
};
