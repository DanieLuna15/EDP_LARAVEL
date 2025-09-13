<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollo_sucursals', function (Blueprint $table) {
            $table->id();
            $table->integer('sucursal_id');
            $table->decimal('precio_cbba', 10, 2)->default(0);
            $table->decimal('precio_lpz', 10, 2)->default(0);
            $table->decimal('peso', 10, 2)->default(0);
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pollo_sucursals');
    }
};
