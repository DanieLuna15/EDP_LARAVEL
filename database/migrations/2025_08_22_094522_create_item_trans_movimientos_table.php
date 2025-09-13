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
        Schema::create('item_trans_movimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->default(1);
            $table->integer('trans_id')->default(1);
            $table->integer('cajas')->default(1);
            $table->decimal('kgb',8,3)->default(0);
            $table->decimal('taras',8,3)->default(0);
            $table->decimal('kgn',8,3)->default(0);
            $table->date('fecha')->nullable();
            $table->text('hora')->nullable();
            $table->text('dia')->nullable();
            $table->text('motivo')->nullable();
            $table->integer('user_id')->default(1);
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
        Schema::dropIfExists('item_trans_movimientos');
    }
};
