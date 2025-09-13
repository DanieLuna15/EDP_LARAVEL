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
        Schema::table('consolidacions_ave_new', function (Blueprint $table) {
            $table->json('detalle_gastos')->nullable()->after('valor_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consolidacions_ave_new', function (Blueprint $table) {
            $table->dropColumn('detalle_gastos');
        });
    }
};
