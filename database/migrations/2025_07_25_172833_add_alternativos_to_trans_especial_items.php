<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlternativosToTransEspecialItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_especial_items', function (Blueprint $table) {
            $table->decimal('precio_alternativo_1', 8, 2)->default(0.00)->after('promedio');
            $table->decimal('precio_alternativo_2', 8, 2)->default(0.00)->after('precio_alternativo_1');
            $table->decimal('precio_alternativo_3', 8, 2)->default(0.00)->after('precio_alternativo_2');
            $table->decimal('precio_alternativo_4', 8, 2)->default(0.00)->after('precio_alternativo_3');
            $table->decimal('precio_alternativo_5', 8, 2)->default(0.00)->after('precio_alternativo_4');

            $table->integer('estado_precio_alternativo_1')->default(0)->after('estado');
            $table->integer('estado_precio_alternativo_2')->default(0)->after('estado_precio_alternativo_1');
            $table->integer('estado_precio_alternativo_3')->default(0)->after('estado_precio_alternativo_2');
            $table->integer('estado_precio_alternativo_4')->default(0)->after('estado_precio_alternativo_3');
            $table->integer('estado_precio_alternativo_5')->default(0)->after('estado_precio_alternativo_4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_especial_items', function (Blueprint $table) {
            // Eliminar columnas
            $table->dropColumn([
                'precio_alternativo_1',
                'precio_alternativo_2',
                'precio_alternativo_3',
                'precio_alternativo_4',
                'precio_alternativo_5',
                'estado_precio_alternativo_1',
                'estado_precio_alternativo_2',
                'estado_precio_alternativo_3',
                'estado_precio_alternativo_4',
                'estado_precio_alternativo_5'
            ]);
        });
    }
}
