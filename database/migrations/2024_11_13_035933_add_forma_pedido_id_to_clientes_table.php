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
            $table->integer('forma_pedido_id')->default(1);
            $table->integer('tipo_negocio_id')->default(1);
            $table->integer('zona_despacho_id')->default(1);
            $table->integer('usuario_id')->default(1);
            $table->integer('preventista_id')->default(1);
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
            $table->dropColumn('forma_pedido_id');
            $table->dropColumn('tipo_negocio_id');
            $table->dropColumn('zona_despacho_id');
            $table->dropColumn('usuario_id');
            $table->dropColumn('preventista_id');
        });
    }
};
