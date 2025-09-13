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
        Schema::create('consolidacions_ave_new', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->integer('compra_ave_id')->default(1);
            $table->integer('consolidacionparam_id')->default(1);
            $table->decimal('peso_total', 10, 2)->default(0.00);
            $table->decimal('valor_total', 10, 2)->default(0.00);
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
        Schema::dropIfExists('consolidacions_ave_new');
    }
};
