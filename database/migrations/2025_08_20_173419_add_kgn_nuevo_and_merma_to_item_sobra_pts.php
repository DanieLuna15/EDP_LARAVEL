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
        Schema::table('item_sobra_pts', function (Blueprint $table) {
            $table->decimal('kgn_nuevo', 8, 3)->default(0)->after('kgn');
            $table->decimal('merma', 8, 3)->default(0)->after('kgn_nuevo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_sobra_pts', function (Blueprint $table) {
            $table->dropColumn(['kgn_nuevo', 'merma']);
        });
    }
};
