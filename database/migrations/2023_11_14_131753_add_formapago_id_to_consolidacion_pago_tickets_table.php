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
        Schema::table('consolidacion_pago_tickets', function (Blueprint $table) {
            $table->integer('formapago_id')->default(1);
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
        Schema::table('consolidacion_pago_tickets', function (Blueprint $table) {
            $table->dropColumn('formapago_id');
            $table->dropColumn('observaciones');
        });
    }
};
