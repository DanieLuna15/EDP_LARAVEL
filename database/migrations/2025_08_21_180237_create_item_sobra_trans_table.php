<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSobraTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_sobra_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->default(1);
            $table->integer('trans_id')->default(1);
            $table->integer('trans_secundario_id')->default(0);
            $table->integer('cajas')->default(1);
            $table->decimal('kgb', 8, 3)->default(0.000);
            $table->decimal('taras', 8, 3)->default(0.000);
            $table->decimal('kgn', 8, 3)->default(0.000);
            $table->decimal('kgn_nuevo', 8, 3)->default(0.000);
            $table->decimal('merma', 8, 3)->default(0.000);
            $table->integer('sobra')->default(1);
            $table->date('fecha')->nullable();
            $table->text('hora')->nullable();
            $table->text('dia')->nullable();
            $table->integer('user_id')->default(1);
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
        Schema::dropIfExists('item_sobra_trans');
    }
}

