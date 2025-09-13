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
        Schema::create('detalle_pt_descomposicions', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->integer('cantidad');
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('peso_total', 10, 2);
            $table->integer('detalle_pt_id')->default(1);
            $table->integer('pt_id')->default(1);
            $table->integer('compo_externa_id')->default(1);
            $table->integer('trozado')->default(1);
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
        Schema::dropIfExists('detalle_pt_descomposicions');
    }
};
