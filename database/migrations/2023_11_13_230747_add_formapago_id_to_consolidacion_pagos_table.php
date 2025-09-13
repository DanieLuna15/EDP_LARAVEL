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
        Schema::table('consolidacion_pagos', function (Blueprint $table) {
            $table->integer('formapago_id')->default(1)->after('banco_id');
            $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consolidacion_pagos', function (Blueprint $table) {
            $table->dropColumn('formapago_id');
            $table->dropColumn('observaciones');
        });
    }
};
