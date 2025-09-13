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
        Schema::create('producto_precio_lotes', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_precio_id')->default(1);
            $table->integer('lote_id')->default(1);
            $table->decimal('precio', 10, 3)->default(0);
            $table->decimal('peso', 10, 3)->default(0);
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
        Schema::dropIfExists('producto_precio_lotes');
    }
};
