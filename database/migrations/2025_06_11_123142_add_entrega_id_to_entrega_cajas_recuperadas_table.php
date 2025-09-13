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
        Schema::table('entrega_cajas_recuperadas', function (Blueprint $table) {
           $table->unsignedBigInteger('entrega_id')->nullable(); 
        });
    }

    public function down()
    {
        Schema::table('entrega_cajas_recuperadas', function (Blueprint $table) {
            $table->dropColumn('entrega_id');
        });
    }
};
