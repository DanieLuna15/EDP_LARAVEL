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
        Schema::create('desplegue_pps', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('pp_id')->default(0);
            $table->integer('cinta_cliente_id')->default(0);
            $table->decimal('cajas', 10, 2)->default(0);
            $table->integer('pollos')->default(0);
            $table->decimal('peso_bruto', 10, 2)->default(0);
            $table->decimal('peso_neto', 10, 2)->default(0);
            $table->decimal('merma_bruta', 10, 2)->default(0);
            $table->decimal('merma_neta', 10, 2)->default(0);
            $table->integer('tipo')->default(1);
            $table->integer('aceptado')->default(0);
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
        Schema::dropIfExists('desplegue_pps');
    }
};
