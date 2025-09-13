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
        Schema::table('item_pollos', function (Blueprint $table) {
            $table->decimal('precio_alternativo_1', 10, 2)->default(0.00)->after('precio_lpz');
            $table->decimal('precio_alternativo_2', 10, 2)->default(0.00)->after('precio_alternativo_1');
            $table->decimal('precio_alternativo_3', 10, 2)->default(0.000)->after('precio_alternativo_2');
            $table->decimal('precio_alternativo_4', 10, 2)->default(0.000)->after('precio_alternativo_3');
            $table->decimal('precio_alternativo_5', 10, 2)->default(0.000)->after('precio_alternativo_4');

            $table->decimal('descuento_alternativo_1', 8, 2)->default(0.00)->after('descuento_4');
            $table->decimal('descuento_alternativo_2', 8, 2)->default(0.00)->after('descuento_alternativo_1');
            $table->decimal('descuento_alternativo_3', 8, 2)->default(0.00)->after('descuento_alternativo_2');
            $table->decimal('descuento_alternativo_4', 8, 2)->default(0.00)->after('descuento_alternativo_3');
            $table->decimal('descuento_alternativo_5', 8, 2)->default(0.00)->after('descuento_alternativo_4');

            $table->boolean('estado_precio_alternativo_1')->default(0)->after('precio_alternativo_4');
            $table->boolean('estado_precio_alternativo_2')->default(0)->after('estado_precio_alternativo_1');
            $table->boolean('estado_precio_alternativo_3')->default(0)->after('estado_precio_alternativo_2');
            $table->boolean('estado_precio_alternativo_4')->default(0)->after('estado_precio_alternativo_3');
            $table->boolean('estado_precio_alternativo_5')->default(0)->after('estado_precio_alternativo_4');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_pollos', function (Blueprint $table) {
            $table->dropColumn([
                'precio_alternativo_1',
                'precio_alternativo_2',
                'precio_alternativo_3',
                'precio_alternativo_4',
                'precio_alternativo_5',
                'descuento_alternativo_1',
                'descuento_alternativo_2',
                'descuento_alternativo_3',
                'descuento_alternativo_4',
                'descuento_alternativo_5',
                'estado_precio_alternativo_1',
                'estado_precio_alternativo_2',
                'estado_precio_alternativo_3',
                'estado_precio_alternativo_4',
                'estado_precio_alternativo_5',
            ]);
        });
    }
};
