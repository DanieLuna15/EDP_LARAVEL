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
        DB::statement('ALTER TABLE cambio_precio_consolidacion_aves MODIFY precio_anterior DECIMAL(10, 2)');
        DB::statement('ALTER TABLE cambio_precio_consolidacion_aves MODIFY precio_actual DECIMAL(10, 2)');
    }

    public function down()
    {
        DB::statement('ALTER TABLE cambio_precio_consolidacion_aves MODIFY precio_anterior DECIMAL(10, 3)');
        DB::statement('ALTER TABLE cambio_precio_consolidacion_aves MODIFY precio_actual DECIMAL(10, 3)');
    }
};
