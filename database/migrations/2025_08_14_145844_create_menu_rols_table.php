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
        Schema::create('menu_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->boolean('check')->default(true);
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles');
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
        if (Schema::hasTable('menu_roles')) {
            Schema::disableForeignKeyConstraints();
            Schema::table('menu_roles', function (Blueprint $table) {
                try {
                    $table->dropForeign(['menu_id']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['rol_id']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['usr_registrado']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['usr_modificado']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['usr_eliminado']);
                } catch (\Throwable $e) {
                }
            });
            Schema::dropIfExists('menu_roles');
            Schema::enableForeignKeyConstraints();
        }

        if (Schema::hasTable('menu_rols')) {
            Schema::disableForeignKeyConstraints();
            Schema::table('menu_rols', function (Blueprint $table) {
                try {
                    $table->dropForeign(['menu_id']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['rol_id']);
                } catch (\Throwable $e) {
                }
            });
            Schema::dropIfExists('menu_rols');
            Schema::enableForeignKeyConstraints();
        }
    }
};
