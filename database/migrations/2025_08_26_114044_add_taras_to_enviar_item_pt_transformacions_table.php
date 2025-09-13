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
        Schema::table('enviar_item_pt_transformacions', function (Blueprint $table) {
            $table->decimal('taras',10,3)->default(0.000)->after('peso_bruto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enviar_item_pt_transformacions', function (Blueprint $table) {
            $table->dropColumn('taras');
        });
    }
};
