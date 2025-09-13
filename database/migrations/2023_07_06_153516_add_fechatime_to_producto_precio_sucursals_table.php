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
        Schema::table('producto_precio_sucursals', function (Blueprint $table) {
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
        Schema::table('producto_precio_sucursals', function (Blueprint $table) {
            $table->dropColumn('f');
            $table->dropColumn('h');
        });
    }
};
