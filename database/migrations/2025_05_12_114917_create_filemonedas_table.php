<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilemonedasTable extends Migration
{
    public function up()
    {
        Schema::create('filemonedas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('file_id')->default(1);
            $table->unsignedInteger('tipoarchivo_id')->default(1);
            $table->unsignedBigInteger('moneda_id')->default(1);
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('filemonedas');
    }
}

