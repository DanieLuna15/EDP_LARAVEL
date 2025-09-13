<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('entrega_cajas', function (Blueprint $table) {
            $table->unsignedBigInteger('chofer_id')->nullable()->after('cliente_id');
        });
    }

    public function down()
    {
        Schema::table('entrega_cajas', function (Blueprint $table) {
            $table->dropColumn('chofer_id');
        });
    }
};