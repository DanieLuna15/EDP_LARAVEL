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
        Schema::table('sub_items', function (Blueprint $table) {
            $table->decimal('descuento_1',8,3)->default(0);
            $table->decimal('descuento_2',8,3)->default(0);
            $table->decimal('descuento_3',8,3)->default(0);
            $table->decimal('descuento_4',8,3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_items', function (Blueprint $table) {
            $table->dropColumn(['descuento_1','descuento_2','descuento_3','descuento_4']);
        });
    }
};
