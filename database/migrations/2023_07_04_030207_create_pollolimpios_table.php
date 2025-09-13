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
        Schema::create('pollolimpios', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->decimal('precio', 8, 2)->default(0);
            $table->decimal('venta_1', 8, 2)->default(0);
            $table->decimal('venta_2', 8, 2)->default(0);
            $table->decimal('venta_3', 8, 2)->default(0);
            $table->decimal('venta_4', 8, 2)->default(0);
            $table->decimal('venta_5', 8, 2)->default(0);
            $table->decimal('venta_6', 8, 2)->default(0);
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
        Schema::dropIfExists('pollolimpios');
    }
};
