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
        Schema::table('sub_item_pt_transformacion_lotes', function (Blueprint $table) {
            $table->decimal('taras', 8, 3)->default(0.000)->after('peso_bruto');
        });

        Schema::table('venta_transformacions', function (Blueprint $table) {
            $table->decimal('taras', 8, 3)->default(0.000)->after('peso_bruto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_item_pt_transformacion_lotes', function (Blueprint $table) {
            $table->dropColumn('taras');
        });

        Schema::table('venta_transformacions', function (Blueprint $table) {
            $table->dropColumn('taras');
        });
    }
};
