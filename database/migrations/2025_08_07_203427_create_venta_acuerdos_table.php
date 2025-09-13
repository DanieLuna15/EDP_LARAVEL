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
        Schema::create('venta_acuerdos', function (Blueprint $table) {
            $table->id();
            $table->integer('venta_id')->default(0);
            $table->text("item")->nullable();
            $table->text("cod")->nullable();
            $table->integer("cajas")->default(0);
            $table->integer("unidad")->default(0);
            $table->decimal("peso_bruto",10,3)->default(0);
            $table->decimal("peso_neto",10,3)->default(0);
            $table->decimal("tara",10,3)->default(0);
            $table->decimal("precio_kg",10,2)->default(0);
            $table->decimal("total",10,2)->default(0);
            $table->integer("estado")->default(1);
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
        Schema::dropIfExists('venta_acuerdos');
    }
};
