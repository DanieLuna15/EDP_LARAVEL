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
        Schema::table('pollolimpio_sucursals', function (Blueprint $table) {
            $table->dateTime('fecha')->nullable();
            $table->text('f')->nullable();
            $table->text('h')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pollolimpio_sucursals', function (Blueprint $table) {
            $table->dropColumn('fecha');
            $table->dropColumn('f');
            $table->dropColumn('h');
        });
    }
};
