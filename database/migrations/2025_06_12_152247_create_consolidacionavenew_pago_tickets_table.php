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
        Schema::create('consolidacionavenew_pago_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consolidacion_pago_id')->default(1); 
            $table->decimal('total', 10, 2)->default(0.00); 
            $table->decimal('monto', 10, 2)->default(0.00); 
            $table->decimal('pendiente', 10, 2)->default(0.00); 
            $table->decimal('deuda', 10, 2)->default(0.00); 
            $table->integer('banco_id')->default(1); 
            $table->integer('estado')->default(1); 
            $table->timestamps(); 
            $table->integer('formapago_id')->default(1); 
            $table->text('observaciones')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidacionavenew_pago_tickets');
    }
};
