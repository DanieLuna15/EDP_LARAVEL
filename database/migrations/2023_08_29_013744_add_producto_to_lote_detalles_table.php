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
        Schema::table('lote_detalles', function (Blueprint $table) {
            $table->string('producto')->nullable();
            $table->string('fecha')->nullable();
            $table->string('tipo')->nullable();
            $table->string('nro')->nullable();
            $table->string('detalle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lote_detalles', function (Blueprint $table) {
            $table->dropColumn('producto');
            $table->dropColumn('fecha');
            $table->dropColumn('tipo');
            $table->dropColumn('nro');
            $table->dropColumn('detalle');
        });
    }
};
