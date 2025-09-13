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
        Schema::table('chofers', function (Blueprint $table) {
            $table->string('placa')->nullable();
            $table->string('modelo')->nullable();
            $table->string('color')->nullable();
            $table->string('zona')->nullable();
            $table->decimal('capacidad', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chofers', function (Blueprint $table) {
            $table->dropColumn('placa');
            $table->dropColumn('modelo');
            $table->dropColumn('color');
            $table->dropColumn('zona');
            $table->dropColumn('capacidad');
        });
    }
};
