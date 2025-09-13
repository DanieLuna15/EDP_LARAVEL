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
        Schema::create('dotacions', function (Blueprint $table) {
            $table->id();
            $table->text('codigo')->nullable();
            $table->text('name')->nullable();
            $table->decimal('costo',8,2)->default(1);
            $table->decimal('venta',8,2)->default(1);
            $table->integer('stock')->default(1);
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
        Schema::dropIfExists('dotacions');
    }
};
