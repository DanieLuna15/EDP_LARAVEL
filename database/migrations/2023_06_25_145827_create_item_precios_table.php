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
        Schema::create('item_precios', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('cambio');
            $table->integer('cambio_precio_id');
            $table->integer('sucursal_id');
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_anterior', 10, 2);
            $table->date('fecha');
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
        Schema::dropIfExists('item_precios');
    }
};
