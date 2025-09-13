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
        Schema::create('compras_aves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(1)->constrained();
            $table->foreignId('sucursal_id')->default(1)->constrained();
            $table->date('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->string('chofer')->nullable();
            $table->string('camion')->nullable();
            $table->string('placa')->nullable();
            $table->string('e_despacho')->nullable();
            $table->string('e_recepcion')->nullable();

            $table->decimal('sum_cant_pollos', 8, 3)->default(0);
            $table->decimal('sum_cant_envases', 8, 3)->default(0); // agregado migracion 3
            $table->decimal('sum_peso_bruto', 8, 3)->default(0);
            $table->decimal('sum_peso_neto', 8, 3)->default(0);
            $table->decimal('sum_retraccion', 8, 3)->default(0); // agregado migracion 3

            $table->integer('estado')->default(1);

            $table->string('nro')->nullable();
            $table->string('nro_compra', 20)->nullable(); // agregado migracion 2

            $table->foreignId('proveedor_compra_id')->default(1)->constrained('proveedor_compras');
            $table->date('fecha_llegada')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->integer('metodo_pago')->default(1);
            $table->foreignId('almacen_id')->default(1)->constrained();
            $table->text('obs')->nullable();

            $table->integer('fin')->default(0); // agregado migracion 3

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
        Schema::dropIfExists('compras_aves');
    }
};
