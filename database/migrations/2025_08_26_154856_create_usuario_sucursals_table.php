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
        Schema::create('usuario_sucursals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('usr_registrado')->nullable();
            $table->foreign('usr_registrado')->references('id')->on('users');
            $table->unsignedBigInteger('usr_modificado')->nullable();
            $table->foreign('usr_modificado')->references('id')->on('users');
            $table->unsignedBigInteger('usr_eliminado')->nullable();
            $table->foreign('usr_eliminado')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('usuario_sucursals');
    }
};
