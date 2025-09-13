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
        Schema::table('item_sobra_trans', function (Blueprint $table) {
            $table->integer('aceptado')->default(0)->after('kgn_nuevo');
            $table->integer('pt_id')->default(1)->nullable()->after('aceptado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_sobra_trans', function (Blueprint $table) {
            $table->dropColumn('aceptado');
            $table->dropColumn('pt_id');
        });
    }
};
