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
        Schema::create('planillacostos', function (Blueprint $table) {
            $table->id();
            $table->integer('planilla_id')->default(1);
            $table->integer('costovariable_id')->default(1);
            $table->decimal('monto',8,2)->default(1);
           
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
        Schema::dropIfExists('planillacostos');
    }
};
