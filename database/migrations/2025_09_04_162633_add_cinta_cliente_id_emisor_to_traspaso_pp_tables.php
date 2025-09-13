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
        Schema::table('traspaso_pps', function (Blueprint $table) {
            $table->unsignedBigInteger('cinta_cliente_id_emisor')->nullable()->after('id');
        });

        Schema::table('traspaso_pp_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('cinta_cliente_id_emisor')->nullable()->after('id');
        });

        Schema::table('traspaso_pp_envios', function (Blueprint $table) {
            $table->unsignedBigInteger('cinta_cliente_id_emisor')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('traspaso_pps', function (Blueprint $table) {
            $table->dropColumn('cinta_cliente_id_emisor');
        });

        Schema::table('traspaso_pp_detalles', function (Blueprint $table) {
            $table->dropColumn('cinta_cliente_id_emisor');
        });

        Schema::table('traspaso_pp_envios', function (Blueprint $table) {
            $table->dropColumn('cinta_cliente_id_emisor');
        });
    }
};
