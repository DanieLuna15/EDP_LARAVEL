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
        Schema::table('lote_detalles', function (Blueprint $table) {
            $table->integer('categoria_id')->default(1);
            $table->integer('medida_producto_id')->default(1);
            $table->integer('sub_medida_id')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lote_detalles', function (Blueprint $table) {
            $table->dropColumn('categoria_id');
            $table->dropColumn('medida_producto_id');
            $table->dropColumn('sub_medida_id');
        });
    }
};
