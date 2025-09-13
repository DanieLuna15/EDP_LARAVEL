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
        Schema::table('compras_aves', function (Blueprint $table) {
            $table->decimal('sum_precio', 8, 2)->default(0)->after('sum_retraccion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras_aves', function (Blueprint $table) {
            $table->dropColumn('sum_precio');
        });
    }
};
