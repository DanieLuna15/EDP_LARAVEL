<?php

namespace Database\Seeders;

use App\Models\Tipopago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class TipoPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipopago::truncate();

        Tipopago::create([
            'name' => 'CONTADO',
            'estado' => 1
        ]);
        Tipopago::create([
            'name' => 'PAGO PARCIAL',
            'estado' => 1
        ]);
        Tipopago::create([
            'name' => 'CREDITO',
            'estado' => 1
        ]);
        Tipopago::create([
            'name' => 'CREDITO ENTREGA',
            'estado' => 1
        ]);
    }
}
