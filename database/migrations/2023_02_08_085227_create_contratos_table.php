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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->text('terminos');
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
            $table->integer('tipocontrato_id')->default(1);
            $table->integer('persona_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('area_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->decimal('sueldo',8,2)->default(1);
            $table->integer('servicio')->default(1);
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
        Schema::dropIfExists('contratos');
    }
};
