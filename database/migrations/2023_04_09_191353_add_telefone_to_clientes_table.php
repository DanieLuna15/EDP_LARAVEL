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
        Schema::table('clientes', function (Blueprint $table) {
            $table->text("telefono")->nullable();
            $table->text("direccion")->nullable();
            $table->text("correo")->nullable();
            $table->decimal("limite_crediticio",8,2)->default(0);
            $table->integer("creditos_activos")->default(1);
            $table->text("dias_horas")->nullable();
            $table->text("latitud")->nullable();
            $table->text("longitud")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn("telefono");
            $table->dropColumn("direccion");
            $table->dropColumn("correo");
            $table->dropColumn("limite_crediticio");
            $table->dropColumn("creditos_activos");
            $table->dropColumn("dias_horas");
            $table->dropColumn("latitud");
            $table->dropColumn("longitud");
        });
    }
};
