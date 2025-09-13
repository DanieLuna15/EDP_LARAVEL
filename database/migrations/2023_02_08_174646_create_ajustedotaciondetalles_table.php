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
        Schema::create('ajustedotaciondetalles', function (Blueprint $table) {
            $table->id();
            $table->integer('stockdotaciondetail_id')->default(1);
            $table->integer('ajustedotacion_id')->default(1);
            $table->decimal('cantidad',8,2)->default(1);
            $table->decimal('antes',8,2)->default(1);
            $table->decimal('ahora',8,2)->default(1);
            $table->decimal('despues',8,2)->default(1);
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
        Schema::dropIfExists('ajustedotaciondetalles');
    }
};
