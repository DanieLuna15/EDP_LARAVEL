<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('arqueo_ventas', function (Blueprint $table) {
            if (!Schema::hasColumn('arqueo_ventas', 'banco_id')) {
                $table->unsignedBigInteger('banco_id')->nullable()->after('formapago_id');
            }

            if (!Schema::hasColumn('arqueo_ventas', 'comprobante_pago')) {
                $table->string('comprobante_pago')->nullable()->after('banco_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arqueo_ventas', function (Blueprint $table) {
            if (Schema::hasColumn('arqueo_ventas', 'comprobante_pago')) {
                $table->dropColumn('comprobante_pago');
            }

            if (Schema::hasColumn('arqueo_ventas', 'banco_id')) {
                $table->dropColumn('banco_id');
            }
        });
    }
};
