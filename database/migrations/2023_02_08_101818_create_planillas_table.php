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
        Schema::create('planillas', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->date('fecha')->nullable();
            $table->date('desde')->nullable();
            $table->date('hasta')->nullable();
            $table->decimal('fijos',8,2)->default(1);
            $table->decimal('valor_vacaciones',8,2)->default(0);
            $table->decimal('sueldo',8,2)->default(1);
            $table->decimal('variables',8,2)->default(1);
            $table->decimal('bruto',8,2)->default(1);
            $table->decimal('extras',8,2)->default(1);
            $table->decimal('extras_n',8,2)->default(1);
            $table->decimal('faltas',8,2)->default(1);
            $table->decimal('faltas_n',8,2)->default(1);
            $table->decimal('atraso',8,2)->default(1);
            $table->decimal('atraso_n',8,2)->default(1);
            $table->decimal('venta_n',8,2)->default(1);
            $table->decimal('venta',8,2)->default(1);
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
        Schema::dropIfExists('planillas');
    }
};
