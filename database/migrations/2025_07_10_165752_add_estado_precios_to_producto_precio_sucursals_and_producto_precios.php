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
        Schema::table('producto_precio_sucursals', function (Blueprint $table) {
            $table->boolean('estado_precio_5')->default(0)->after('venta_5');
            $table->boolean('estado_precio_6')->default(0)->after('venta_6');
            $table->boolean('estado_precio_7')->default(0)->after('venta_7');
            $table->boolean('estado_precio_8')->default(0)->after('venta_8');
            $table->tinyInteger('tipo_cambio')->default(1)->after('cambio');
        });

        Schema::table('producto_precios', function (Blueprint $table) {
            $table->boolean('estado_precio_5')->default(0)->after('venta_5');
            $table->boolean('estado_precio_6')->default(0)->after('venta_6');
            $table->boolean('estado_precio_7')->default(0)->after('venta_7');
            $table->boolean('estado_precio_8')->default(0)->after('venta_8');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_precio_sucursals', function (Blueprint $table) {
            $table->dropColumn(['estado_precio_5', 'estado_precio_6', 'estado_precio_7', 'estado_precio_8', 'tipo_cambio']);
        });
        Schema::table('producto_precios', function (Blueprint $table) {
            $table->dropColumn(['estado_precio_5', 'estado_precio_6', 'estado_precio_7', 'estado_precio_8']);
        });
    }
};
