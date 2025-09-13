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
        Schema::table('consolidacion_ave_new_detalles', function (Blueprint $table) {
            $table->string('observacion')->nullable()->after('nro_lote');
        });
    }

    public function down()
    {
        Schema::table('consolidacion_ave_new_detalles', function (Blueprint $table) {
            $table->dropColumn('observacion');
        });
    }
};
