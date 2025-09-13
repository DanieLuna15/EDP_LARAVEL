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
        Schema::create('items_pts', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->integer('pt_id')->nullable();
            $table->integer('descomponer_pt_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->decimal('cajas', 8, 2)->nullable();
            $table->decimal('taras', 8, 2)->nullable();
            $table->decimal('peso_bruto', 8, 2)->nullable();
            $table->decimal('peso_neto', 8, 2)->nullable();
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
        Schema::dropIfExists('items_pts');
    }
};
