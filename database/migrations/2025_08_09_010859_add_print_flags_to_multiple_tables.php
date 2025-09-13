<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->timestamp('cobranza_first_printed_at')->nullable()->after('updated_at');
            $table->unsignedInteger('cobranza_print_count')->default(0)->after('cobranza_first_printed_at');

            $table->timestamp('ticket_cobranza_first_printed_at')->nullable()->after('updated_at');
            $table->unsignedInteger('ticket_cobranza_print_count')->default(0)->after('cobranza_first_printed_at');
        });

        Schema::table('entrega_cajas', function (Blueprint $table) {
            // Admin
            $table->timestamp('cajas_first_printed_at')->nullable()->after('updated_at');
            $table->unsignedInteger('cajas_print_count')->default(0)->after('cajas_first_printed_at');

            $table->timestamp('cajas_chofer_first_printed_at')->nullable()->after('cajas_print_count');
            $table->unsignedInteger('cajas_chofer_print_count')->default(0)->after('cajas_chofer_first_printed_at');
        });

        Schema::table('pagos_globales', function (Blueprint $table) {
            $table->timestamp('ticket_first_printed_at')->nullable()->after('updated_at');
            $table->unsignedInteger('ticket_print_count')->default(0)->after('ticket_first_printed_at');
        });

        Schema::table('arqueo_ventas', function (Blueprint $table) {
            $table->timestamp('ticket_first_printed_at')->nullable()->after('updated_at');
            $table->unsignedInteger('ticket_print_count')->default(0)->after('ticket_first_printed_at');
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn(['cobranza_first_printed_at', 'cobranza_print_count', 'ticket_cobranza_first_printed_at', 'ticket_cobranza_print_count']);
        });

        Schema::table('entrega_cajas', function (Blueprint $table) {
            $table->dropColumn([
                'cajas_first_printed_at',
                'cajas_print_count',
                'cajas_chofer_first_printed_at',
                'cajas_chofer_print_count',
            ]);
        });

        Schema::table('pagos_globales', function (Blueprint $table) {
            $table->dropColumn(['ticket_first_printed_at', 'ticket_print_count']);
        });

        Schema::table('arqueo_ventas', function (Blueprint $table) {
            $table->dropColumn(['ticket_first_printed_at', 'ticket_print_count']);
        });
    }
};
