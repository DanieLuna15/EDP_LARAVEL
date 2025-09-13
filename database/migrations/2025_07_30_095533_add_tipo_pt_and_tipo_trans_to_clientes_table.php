<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoPtAndTipoTransToClientesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('tipo_pt')->default(1)->after('chofer_id');
            $table->integer('tipo_trans')->default(1)->after('tipo_pt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('tipo_pt');
            $table->dropColumn('tipo_trans');
        });
    }
}
