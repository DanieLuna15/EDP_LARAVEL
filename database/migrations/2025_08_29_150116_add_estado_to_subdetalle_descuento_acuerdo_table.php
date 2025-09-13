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
        Schema::table('subdetalle_descuento_acuerdo', function (Blueprint $table) {
            $table->tinyInteger('estado')->default(1)->after('venta_detalle_pp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subdetalle_descuento_acuerdo', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
