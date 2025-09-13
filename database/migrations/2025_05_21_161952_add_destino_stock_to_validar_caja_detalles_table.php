<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('validar_caja_detalles', function (Blueprint $table) {
            $table->decimal('destino_stock_anterior', 10, 3)->default(0.000)->after('stock');
            $table->decimal('destino_stock_actual', 10, 3)->default(0.000)->after('destino_stock_anterior');
        });
    }

    public function down()
    {
        Schema::table('validar_caja_detalles', function (Blueprint $table) {
            $table->dropColumn(['destino_stock_anterior', 'destino_stock_actual']);
        });
    }
};
