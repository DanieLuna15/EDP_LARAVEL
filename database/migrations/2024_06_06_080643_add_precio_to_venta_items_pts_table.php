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
        Schema::table('venta_items_pts', function (Blueprint $table) {
            $table->decimal('precio',8,2)->default(0);
            $table->decimal('total',8,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venta_items_pts', function (Blueprint $table) {
            $table->dropColumn(['total','precio']);
        });
    }
};
