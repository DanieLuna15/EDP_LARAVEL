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
            $table->decimal('dinero_cuenta', 10, 2)->default(0);
            $table->decimal('deuda_heredada', 10, 2)->default(0);
            $table->integer('tipo_caja_cerrada')->default(1);
            $table->integer('tipo_cliente_pp')->default(1);
            $table->integer('tipo_pollo_limpia')->default(1);
            $table->integer('acuerdo')->default(1);
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
                
                $table->dropColumn('dinero_cuenta');
                $table->dropColumn('deuda_heredada');
                $table->dropColumn('tipo_caja_cerrada');
                $table->dropColumn('tipo_cliente_pp');
                $table->dropColumn('tipo_pollo_limpia');
                $table->dropColumn('acuerdo');
        });
    }
};
