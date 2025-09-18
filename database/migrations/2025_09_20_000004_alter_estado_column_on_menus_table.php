<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE menus MODIFY estado TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 eliminado, 1 visible, 2 oculto'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE menus MODIFY estado TINYINT(1) NOT NULL DEFAULT 1");
    }
};
