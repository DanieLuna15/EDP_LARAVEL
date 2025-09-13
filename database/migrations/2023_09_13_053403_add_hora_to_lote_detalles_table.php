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
            $table->text('hora')->nullable()->after('fecha');
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
        Schema::table('lote_detalles', function (Blueprint $table) {
            $table->dropColumn('hora');
            $table->dropColumn('user_id');
        });
    }
};
