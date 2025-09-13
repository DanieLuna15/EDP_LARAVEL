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
        Schema::table('traspaso_pp_detalles', function (Blueprint $table) {
            $table->integer('pigmento')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traspaso_pp_detalles', function (Blueprint $table) {
            $table->dropColumn('pigmento');
        });
    }
};
