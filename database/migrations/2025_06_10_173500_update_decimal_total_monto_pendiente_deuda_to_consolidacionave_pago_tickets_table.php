<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY total DECIMAL(10, 2)');
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY monto DECIMAL(10, 2)');
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY pendiente DECIMAL(10, 2)');
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY deuda DECIMAL(10, 2)');
    }

    public function down()
    {
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY total DECIMAL(10, 3)');
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY monto DECIMAL(10, 3)');
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY pendiente DECIMAL(10, 3)');
        DB::statement('ALTER TABLE consolidacionave_pago_tickets MODIFY deuda DECIMAL(10, 3)');
    }
};
