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
            $table->string('id_nro')->nullable()->after('nro');
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
            $table->dropColumn('id_nro');
        });
    }
};
