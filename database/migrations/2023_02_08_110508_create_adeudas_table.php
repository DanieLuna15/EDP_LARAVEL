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
        Schema::create('adeudas', function (Blueprint $table) {
            $table->id();
            $table->integer('planilla_id')->default(1);
            $table->integer('contrato_id')->default(1);
            $table->date('fecha')->nullable();
            $table->decimal('monto',8,2)->default(1);
            $table->text('motivo')->nullable();
            $table->integer('plan')->default(1);
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
        Schema::dropIfExists('adeudas');
    }
};
