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
        Schema::table('validar_cajas', function (Blueprint $table) {
            $table->text('chofer')->nullable();
            $table->text('placa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('validar_cajas', function (Blueprint $table) {
            $table->dropColumn('chofer');
            $table->dropColumn('placa');
        });
    }
};
