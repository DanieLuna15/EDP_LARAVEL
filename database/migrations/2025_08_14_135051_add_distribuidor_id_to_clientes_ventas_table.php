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
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('distribuidor_id')->notNullable()->default(1);
        });
        Schema::table('ventas', function (Blueprint $table) {
            $table->integer('distribuidor_id')->notNullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('distribuidor_id');
        });
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('distribuidor_id');
        });
    }
};
