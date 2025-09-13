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
        Schema::table('venta_detalle_pps', function (Blueprint $table) {
            $table->integer('tipo_pp')->default(0)->after('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venta_detalle_pps', function (Blueprint $table) {
            $table->dropColumn('tipo_pp');
        });
    }
};
