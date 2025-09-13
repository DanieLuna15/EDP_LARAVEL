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
        Schema::create('cambio_precio_consolidacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consolidacion_id')->constrained('consolidacions');
            $table->foreignId('consolidacion_detalle_id')->constrained('consolidacion_detalles');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('precio_anterior', 10, 2);
            $table->decimal('precio_actual', 10, 2);
            $table->integer('nro_cambio')->default(0);
            $table->dateTime('fecha_cambio')->nullable();
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
        Schema::dropIfExists('cambio_precio_consolidacions');
    }
};
