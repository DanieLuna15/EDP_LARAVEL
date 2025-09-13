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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->text('nombre')->nullable();
            $table->text('apellidos')->nullable();
            $table->integer('documento_id')->default(1);
            $table->text('doc')->nullable();
            $table->text('telefono')->nullable();
            $table->text('cargo')->nullable();
            $table->text('garante')->nullable();
            $table->text('cel_garante')->nullable();
            $table->text('dir_garante')->nullable();
            $table->text('direccion')->nullable();
            $table->integer('estado')->default(1);
            $table->integer('inactivo')->default(1);
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
        Schema::dropIfExists('personas');
    }
};
