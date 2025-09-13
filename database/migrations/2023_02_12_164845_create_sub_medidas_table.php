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
        Schema::create('sub_medidas', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->decimal('valor_1',8,3)->default(0);
            $table->decimal('valor_2',8,3)->default(0);
            $table->integer('medida_producto_id')->default(1);
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
        Schema::dropIfExists('sub_medidas');
    }
};
