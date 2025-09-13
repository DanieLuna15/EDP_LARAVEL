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
        Schema::table('detalle_pps', function (Blueprint $table) {
            $table->integer('peso_inicial_tipo')->default(1);
            $table->text('hora')->nullable();
            $table->integer('user_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_pps', function (Blueprint $table) {
            $table->dropColumn('peso_inicial_tipo');
            $table->dropColumn('hora');
            $table->dropColumn('user_id');
        });
    }
};
