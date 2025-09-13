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
        Schema::create('promedio_pollolimpios', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio_1', 8, 2)->default(0);
            $table->decimal('peso_1', 8, 2)->default(0);
            $table->decimal('precio_2', 8, 2)->default(0);
            $table->decimal('peso_2', 8, 2)->default(0);
            $table->decimal('precio_3', 8, 2)->default(0);
            $table->decimal('peso_3', 8, 2)->default(0);
            $table->decimal('precio_4', 8, 2)->default(0);
            $table->decimal('peso_4', 8, 2)->default(0);
            $table->decimal('precio_5', 8, 2)->default(0);
            $table->decimal('peso_5', 8, 2)->default(0);
            $table->decimal('precio_6', 8, 2)->default(0);
            $table->decimal('peso_6', 8, 2)->default(0);
            $table->integer('sucursal_id')->default(1);
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
        Schema::dropIfExists('promedio_pollolimpios');
    }
};
