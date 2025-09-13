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
        Schema::create('stockdotacions', function (Blueprint $table) {
            $table->id();
            $table->integer('sucursal_id')->default(1);
            $table->integer('proveedor_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('formapago_id')->default(1);
            $table->date('fecha')->nullable();
            $table->text('motivo')->nullable();
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
        Schema::dropIfExists('stockdotacions');
    }
};
