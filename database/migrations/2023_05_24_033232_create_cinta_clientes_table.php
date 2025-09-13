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
        Schema::create('cinta_clientes', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->decimal('inicio', 10, 2)->nullable();
            $table->decimal('fin', 10, 2)->nullable();
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
        Schema::dropIfExists('cinta_clientes');
    }
};
