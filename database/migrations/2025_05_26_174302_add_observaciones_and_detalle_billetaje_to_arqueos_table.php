<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObservacionesAndDetalleBilletajeToArqueosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arqueos', function (Blueprint $table) {
            // Agregar los nuevos campos
            $table->text('observaciones')->nullable()->after('estado');
            $table->json('detalle_billetaje')->nullable()->after('observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arqueos', function (Blueprint $table) {
            // Eliminar los campos en caso de reversión
            $table->dropColumn('observaciones');
            $table->dropColumn('detalle_billetaje');
        });
    }
}
