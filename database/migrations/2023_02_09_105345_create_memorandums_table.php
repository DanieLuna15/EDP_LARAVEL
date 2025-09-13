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
        Schema::create('memorandums', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('sucursal_id')->default(1);
            $table->integer('motivomemorandum_id')->default(1);
            $table->text('descripciom')->nullable();
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('memorandums');
    }
};
