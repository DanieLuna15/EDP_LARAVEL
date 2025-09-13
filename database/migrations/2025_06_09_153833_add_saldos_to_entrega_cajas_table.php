<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaldosToEntregaCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrega_cajas', function (Blueprint $table) {
            $table->integer('saldo_anterior')->default(0)->after('cliente_id');
            $table->integer('saldo_actual')->default(0)->after('cajas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrega_cajas', function (Blueprint $table) {
            $table->dropColumn('saldo_anterior');
            $table->dropColumn('saldo_actual');
        });
    }
}
