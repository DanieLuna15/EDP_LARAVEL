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
        Schema::create('sub_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->default(1);
            $table->integer('sub_item_id')->default(1);
            $table->decimal('precio', 10, 3)->default(0);
            $table->decimal('peso', 10, 3)->default(0);
            $table->decimal('promedio', 10, 3)->default(0);
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
        Schema::dropIfExists('sub_items');
    }
};
