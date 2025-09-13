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
            $table->decimal('descuento_1',10,3)->default(0);
            $table->decimal('descuento_2',10,3)->default(0);
            $table->decimal('descuento_3',10,3)->default(0);
            $table->decimal('descuento_4',10,3)->default(0);
            $table->decimal('descuento_5',10,3)->default(0);
            $table->decimal('descuento_6',10,3)->default(0);
            $table->decimal('descuento_7',10,3)->default(0);
            $table->decimal('descuento_8',10,3)->default(0);
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
            $table->dropColumn('descuento_1');
            $table->dropColumn('descuento_2');
            $table->dropColumn('descuento_3');
            $table->dropColumn('descuento_4');
            $table->dropColumn('descuento_5');
            $table->dropColumn('descuento_6');
            $table->dropColumn('descuento_7');
            $table->dropColumn('descuento_8');
        });
    }
};
