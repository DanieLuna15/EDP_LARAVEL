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
        Schema::table('trans_items', function (Blueprint $table) {
            $table->decimal('suma_promedio',8,3)->default(0);
            $table->decimal('promedio_item',8,3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trans_items', function (Blueprint $table) {
            $table->dropColumn('suma_promedio');
            $table->dropColumn('promedio_item');
        });
    }
};
