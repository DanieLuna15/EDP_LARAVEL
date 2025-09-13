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
        Schema::create('informe_preliminars', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->text('dia')->nullable();
            $table->text('observacion')->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('cant',8,2)->default(0);
            $table->decimal('cajas',8,2)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('kg',8,2)->default(0);
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
        Schema::dropIfExists('informe_preliminars');
    }
};
