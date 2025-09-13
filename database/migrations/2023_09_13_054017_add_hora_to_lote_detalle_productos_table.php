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
        Schema::table('lote_detalle_productos', function (Blueprint $table) {
            $table->text('hora')->nullable()->after('fecha');
            $table->integer('user_id')->default(1);
            $table->integer('tipo_mov')->default(1)->after('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lote_detalle_productos', function (Blueprint $table) {
            $table->dropColumn('hora');
            $table->dropColumn('user_id');
            $table->dropColumn('tipo_mov');
        });
    }
};
