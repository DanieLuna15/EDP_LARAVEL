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
        Schema::table('consolidacion_detalles', function (Blueprint $table) {
            $table->integer('compra_id')->default(1);
            $table->decimal('lp',8,2)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('kg_total',8,2)->default(0);
            $table->decimal('kg_criterio',8,2)->default(0);
            $table->decimal('kg_criterio_total',8,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consolidacion_detalles', function (Blueprint $table) {
            $table->dropColumn('compra_id');
            $table->dropColumn('lp');
            $table->dropColumn('pollos');
            $table->dropColumn('kg_total');
            $table->dropColumn('kg_criterio');
            $table->dropColumn('kg_criterio_total');
        });
    }
};
