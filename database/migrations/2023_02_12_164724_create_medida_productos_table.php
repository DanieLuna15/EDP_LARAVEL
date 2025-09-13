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
        Schema::create('medida_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('medida_id')->default(1);
            $table->integer('producto_id')->default(1);
            $table->decimal('valor',8,3)->default(0);
            $table->integer('estado')->default(1);
            $table->integer('principal')->default(1);
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
        Schema::dropIfExists('medida_productos');
    }
};
