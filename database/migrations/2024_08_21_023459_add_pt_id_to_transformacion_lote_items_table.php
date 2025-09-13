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
        Schema::table('transformacion_lote_items', function (Blueprint $table) {
            $table->integer('pt_id')->default(1);
            $table->decimal('tara', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transformacion_lote_items', function (Blueprint $table) {
            $table->dropColumn('pt_id');
            $table->dropColumn('tara');
        });
    }
};
