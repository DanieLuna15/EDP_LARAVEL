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
            $table->unsignedTinyInteger('tipo')->default(3)->after('item_id')->index();
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
            $table->dropColumn('tipo');
        });
    }
};
