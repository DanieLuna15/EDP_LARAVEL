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
        Schema::table('items_pts', function (Blueprint $table) {
            $table->integer('pp_emisor_id')->nullable();
            $table->integer('pt_emisor_id')->nullable();
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
        Schema::table('items_pts', function (Blueprint $table) {
            $table->dropColumn('pp_emisor_id');
            $table->dropColumn('pt_emisor_id');
            $table->dropColumn('user_id');
        });
    }
};
