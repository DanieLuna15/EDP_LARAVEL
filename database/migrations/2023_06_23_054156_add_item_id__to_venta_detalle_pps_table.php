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
        Schema::table('venta_detalle_pps', function (Blueprint $table) {
            $table->integer('item_id')->default(1);
            $table->decimal('precio', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venta_detalle_pps', function (Blueprint $table) {
            $table->dropColumn('item_id');
            $table->dropColumn('precio');
        });
    }
};
