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
        Schema::create('cambio_precio_consolidacion_aves_new', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consolidacion_id');
            $table->unsignedBigInteger('consolidacion_detalle_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('precio_anterior', 10, 3);
            $table->decimal('precio_actual', 10, 3);
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
        Schema::dropIfExists('cambio_precio_consolidacion_aves_new');
    }
};
