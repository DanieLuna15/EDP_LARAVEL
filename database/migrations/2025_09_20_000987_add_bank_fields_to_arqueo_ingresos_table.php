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
        Schema::table('arqueo_ingresos', function (Blueprint $table) {
            if (!Schema::hasColumn('arqueo_ingresos', 'banco_id')) {
                $table->unsignedBigInteger('banco_id')->nullable()->after('formapago_id');
            }

            if (!Schema::hasColumn('arqueo_ingresos', 'nro_comprobante')) {
                $table->string('nro_comprobante')->nullable()->after('banco_id');
            }

            if (!Schema::hasColumn('arqueo_ingresos', 'obs')) {
                $table->text('obs')->nullable()->after('nro_comprobante');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arqueo_ingresos', function (Blueprint $table) {
            if (Schema::hasColumn('arqueo_ingresos', 'obs')) {
                $table->dropColumn('obs');
            }

            if (Schema::hasColumn('arqueo_ingresos', 'nro_comprobante')) {
                $table->dropColumn('nro_comprobante');
            }

            if (Schema::hasColumn('arqueo_ingresos', 'banco_id')) {
                $table->dropColumn('banco_id');
            }
        });
    }
};
