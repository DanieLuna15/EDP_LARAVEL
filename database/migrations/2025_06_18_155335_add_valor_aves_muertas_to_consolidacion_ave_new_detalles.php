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
        Schema::table('consolidacions_ave_new', function (Blueprint $table) {
            $table->decimal('valor_aves_muertas', 10, 2)->default(0.00)->after('valor_total');
            $table->decimal('valor_por_ave_muerta', 10, 2)->default(0.00)->after('valor_aves_muertas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consolidacions_ave_new', function (Blueprint $table) {
            $table->dropColumn('valor_aves_muertas');
            $table->dropColumn('valor_por_ave_muerta');
        });
    }
};
