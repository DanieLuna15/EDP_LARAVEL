<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entrega_cajas', function (Blueprint $table) {
            if (!Schema::hasColumn('entrega_cajas', 'observacion')) {
                $table->text('observacion')->nullable()->after('venta_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('entrega_cajas', function (Blueprint $table) {
            if (Schema::hasColumn('entrega_cajas', 'observacion')) {
                $table->dropColumn('observacion');
            }
        });
    }
};
