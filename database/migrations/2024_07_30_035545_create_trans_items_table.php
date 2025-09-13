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
        Schema::create('trans_items', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->integer('item_id')->default(0);
            $table->decimal('precio',8,3)->default(0);
            $table->decimal('peso',8,3)->default(0);
            $table->decimal('promedio',8,3)->default(0);
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
        Schema::dropIfExists('trans_items');
    }
};
