<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arqueo_ventas', function (Blueprint $table) {
            if (!Schema::hasColumn('arqueo_ventas', 'observacion')) {
                $table->text('observacion')->nullable()->after('cambio');
            }
        });
    }

    public function down(): void
    {
        Schema::table('arqueo_ventas', function (Blueprint $table) {
            if (Schema::hasColumn('arqueo_ventas', 'observacion')) {
                $table->dropColumn('observacion');
            }
        });
    }
};
