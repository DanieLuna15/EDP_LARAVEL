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
            $table->decimal('venta_1', 10, 2)->default(0);
            $table->decimal('venta_3', 10, 2)->default(0);
            $table->decimal('venta_4', 10, 2)->default(0);
            $table->decimal('venta_5', 10, 2)->default(0);
            $table->decimal('venta_6', 10, 2)->default(0);

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
            $table->dropColumn('venta_1');
            $table->dropColumn('venta_3');
            $table->dropColumn('venta_4');
            $table->dropColumn('venta_5');
            $table->dropColumn('venta_6');
        });
    }
};
