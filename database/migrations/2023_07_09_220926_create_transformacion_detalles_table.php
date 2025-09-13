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
        Schema::create('transformacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->decimal('peso', 10, 2)->default(0);
            $table->decimal('precio', 10, 2)->default(0);
            $table->decimal('promedio', 10, 2)->default(0);
            $table->integer('transformacion_id')->default(1);
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
        Schema::dropIfExists('transformacion_detalles');
    }
};
