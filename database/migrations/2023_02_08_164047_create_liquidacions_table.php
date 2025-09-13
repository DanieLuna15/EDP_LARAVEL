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
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->id();
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('contrato_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->text('dia')->default(1);
            $table->text('mes')->default(1);
            $table->integer('user_id')->default(1);
            $table->decimal('sueldo_diario',8,2)->default(1);
            $table->decimal('sueldo_mensual',8,2)->default(1);
            $table->decimal('sueldo_bruto',8,2)->default(1);
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
        Schema::dropIfExists('liquidacions');
    }
};
