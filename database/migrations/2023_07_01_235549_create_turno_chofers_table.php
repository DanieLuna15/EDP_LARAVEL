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
        Schema::create('turno_chofers', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->integer('chofer_id')->default(1);
            $table->integer('apertura')->default(1);
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
        Schema::dropIfExists('turno_chofers');
    }
};
