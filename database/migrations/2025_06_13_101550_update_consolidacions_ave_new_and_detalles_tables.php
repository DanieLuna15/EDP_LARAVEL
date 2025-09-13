<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConsolidacionsAveNewAndDetallesTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (Schema::hasColumn('consolidacions_ave_new', 'compra_ave_id')) {
            Schema::table('consolidacions_ave_new', function (Blueprint $table) {
                $table->dropColumn('compra_ave_id');
                $table->integer('sucursal_id')->default(1)->after('id');
                $table->integer('user_id')->default(1)->after('sucursal_id');
            });
        }
        Schema::table('consolidacion_ave_new_detalles', function (Blueprint $table) {
            if (Schema::hasColumn('consolidacion_ave_new_detalles', 'compra_ave_id')) {
                $table->dropColumn('compra_ave_id');
            }
            $table->date('fecha')->nullable()->after('id');
            $table->string('nro_lote')->after('id');
            $table->integer('cantidad_jaulas')->default(0)->after('kg_criterio_total');
            $table->decimal('tara', 10, 3)->default(0.000)->after('cantidad_jaulas');
            $table->decimal('peso_bruto', 10, 3)->default(0.000)->after('tara');
            $table->string('proveedor')->after('peso_bruto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('consolidacions_ave_new', function (Blueprint $table) {
            $table->integer('compra_ave_id')->default(1)->after('fecha');
            $table->dropColumn('sucursal_id');
            $table->dropColumn('user_id');
        });
        Schema::table('consolidacion_ave_new_detalles', function (Blueprint $table) {
            $table->integer('compra_ave_id')->default(1)->after('consolidacion_id');
            $table->dropColumn(['fecha', 'nro_lote','cantidad_jaulas', 'tara', 'peso_bruto', 'proveedor']);
        });
    }
}
