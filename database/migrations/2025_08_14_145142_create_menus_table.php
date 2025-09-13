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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id')->nullable();
            $table->string('icon');
            $table->string('route')->nullable();
            $table->string('label');
            $table->integer('level')->default(0);
            $table->integer('order')->nullable();
            $table->string('file')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('menus');
        Schema::enableForeignKeyConstraints();
    }
};
