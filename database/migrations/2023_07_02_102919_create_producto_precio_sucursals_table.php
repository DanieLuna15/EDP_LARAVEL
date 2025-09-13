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
        Schema::create('producto_precio_sucursals', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_precio_id');
            $table->integer('cambio');
            $table->integer('producto_precio_cambio_id');
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
        Schema::dropIfExists('producto_precio_sucursals');
    }
};
