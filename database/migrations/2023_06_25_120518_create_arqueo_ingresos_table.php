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
        Schema::create('arqueo_ingresos', function (Blueprint $table) {
            $table->id();
            $table->text('nro')->nullable();
            $table->text('cajamotivo_id')->nullable();
            $table->integer('arqueo_id');
            $table->integer('tipo');
            $table->integer('formapago_id');
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
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
        Schema::dropIfExists('arqueo_ingresos');
    }
};
