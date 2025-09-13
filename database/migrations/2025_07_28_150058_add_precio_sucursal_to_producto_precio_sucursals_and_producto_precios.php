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
            $table->decimal('venta_9', 8, 2)->default(0.000)->after('descuento_9');
            $table->decimal('descuento_10', 8, 2)->default(0.000)->after('venta_9');
            $table->boolean('estado_precio_9', 8, 2)->default(0)->after('descuento_10');

            $table->decimal('venta_10', 8, 2)->default(0.000)->after('descuento_10');
            $table->decimal('descuento_11', 8, 2)->default(0.000)->after('venta_10');
            $table->boolean('estado_precio_10', 8, 2)->default(0)->after('descuento_11');

            $table->decimal('venta_11', 8, 2)->default(0.000)->after('descuento_11');
            $table->decimal('descuento_12', 8, 2)->default(0.000)->after('venta_11');
            $table->boolean('estado_precio_11', 8, 2)->default(0)->after('descuento_12');

            $table->decimal('venta_12', 8, 2)->default(0.000)->after('descuento_12');
            $table->decimal('descuento_13', 8, 2)->default(0.000)->after('venta_12');
            $table->boolean('estado_precio_12', 8, 2)->default(0)->after('descuento_13');
        });

        Schema::table('producto_precios', function (Blueprint $table) {
            $table->decimal('venta_9', 8, 2)->default(0.000)->after('descuento_9');
            $table->decimal('descuento_10', 8, 2)->default(0.000)->after('venta_9');
            $table->boolean('estado_precio_9', 8, 2)->default(0)->after('descuento_10');

            $table->decimal('venta_10', 8, 2)->default(0.000)->after('descuento_10');
            $table->decimal('descuento_11', 8, 2)->default(0.000)->after('venta_10');
            $table->boolean('estado_precio_10', 8, 2)->default(0)->after('descuento_11');

            $table->decimal('venta_11', 8, 2)->default(0.000)->after('descuento_11');
            $table->decimal('descuento_12', 8, 2)->default(0.000)->after('venta_11');
            $table->boolean('estado_precio_11', 8, 2)->default(0)->after('descuento_12');

            $table->decimal('venta_12', 8, 2)->default(0.000)->after('descuento_12');
            $table->decimal('descuento_13', 8, 2)->default(0.000)->after('venta_12');
            $table->boolean('estado_precio_12', 8, 2)->default(0)->after('descuento_13');
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
            $table->dropColumn(['venta_9', 'descuento_10', 'estado_precio_9','venta_10', 'descuento_11', 'estado_precio_10','venta_11', 'descuento_12', 'estado_precio_11','venta_12', 'descuento_13', 'estado_precio_12']);
        });
        Schema::table('producto_precios', function (Blueprint $table) {
            $table->dropColumn(['venta_9', 'descuento_10', 'estado_precio_9','venta_10', 'descuento_11', 'estado_precio_10','venta_11', 'descuento_12', 'estado_precio_11','venta_12', 'descuento_13', 'estado_precio_12']);
        });
    }
};
