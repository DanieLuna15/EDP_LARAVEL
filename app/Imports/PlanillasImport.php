<?php

namespace App\Imports;

use App\Models\Contrato;
use App\Models\CogPlanilla;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;

class PlanillasImport implements ToCollection, WithHeadingRow
{
    protected $results = [
        'procesados' => 0,
        'errores' => [],
    ];

    public function collection(Collection $rows)
    {
        Log::info("Inicio importación de planillas. Total filas: " . count($rows));

        // Obtener configuración global activa de cogplanilla
        $cogplanilla = CogPlanilla::where('estado', 1)->first();

        if (!$cogplanilla) {
            Log::error("No se encontró configuración activa en cogplanillas.");
            return;
        }

        foreach ($rows as $index => $row) {
            $fila = $index + 2; // para reportes +2 por encabezado y base 0
            Log::info("Procesando fila $fila: " . json_encode($row));

            // Validar campos obligatorios
            if (empty($row['documento']) || empty($row['desde']) || empty($row['hasta'])) {
                $msg = "Fila $fila: Campos obligatorios (documento, desde, hasta) faltantes.";
                Log::warning($msg);
                $this->results['errores'][] = $msg;
                continue;
            }

            $faltas  = is_numeric($row['faltas_n'])   ? (int)$row['faltas_n']   : 0;
            $atrasos = is_numeric($row['atrasos_n'])  ? (int)$row['atrasos_n']  : 0;
            $extras  = is_numeric($row['extras_n'])   ? (int)$row['extras_n']   : 0;
            $vendida = is_numeric($row['venta_caja_n']) ? (int)$row['venta_caja_n'] : 0;

            $adeuda       = is_numeric($row['adeuda']) ? (float)$row['adeuda'] : 0;
            $plan         = is_numeric($row['plan']) ? (int)$row['plan'] : 0;
            $motivo_adeudo = $row['motivo_adeudo'] ?? '';

            $contrato = Contrato::with('persona', 'contratocostos.costofijo')->whereHas('persona', function ($q) use ($row) {
                $q->where('doc', $row['documento']);
            })->first();

            if (!$contrato) {
                $msg = "Fila $fila: No se encontró contrato activo para documento '{$row['documento']}'.";
                Log::error($msg);
                $this->results['errores'][] = $msg;
                continue;
            }

            Log::info("Fila $fila: Contrato encontrado ID {$contrato->id} para documento {$row['documento']}");

            $porcentajeFijos = $contrato->contratocostos->sum(function ($contratocosto) {
                return $contratocosto->costofijo ? $contratocosto->costofijo->monto : 0;
            });

            Log::info("Fila $fila: Suma costos fijos porcentaje: $porcentajeFijos");
            $diasBase = $cogplanilla->dias_base ?? 30;
            $horasPorDia = $cogplanilla->dividir_hora ?? 8;
            $multiplicador = $cogplanilla->multiplicar ?? 1;
            $atrasoFactor = $cogplanilla->atraso ?? 1;
            $sueldoBaseCog = $cogplanilla->sueldo_base ?? 2250;

            $sueldoBase = $contrato->sueldo;
            $sueldoBruto = round($sueldoBase - ($sueldoBase * $porcentajeFijos / 100), 2);
            $valorFaltas = round(-1 * $faltas * ($sueldoBase / $diasBase), 2);
            $valorExtras = round($extras * ($sueldoBaseCog / $diasBase / $horasPorDia), 2);
            $valorVendidaCaja = round($multiplicador * $vendida, 2);

            if ($atrasos >= $cogplanilla->atraso) {
                $valorAtraso = round(-1 * ($atrasos / $atrasoFactor) * ($sueldoBase / $diasBase), 2);
            } else {
                $valorAtraso = 0;
            }

            $bruto = round($sueldoBruto + $valorExtras + $valorVendidaCaja + $valorFaltas + $valorAtraso, 2);

            Log::info("Fila $fila: sueldoBase: $sueldoBase, sueldoBruto: $sueldoBruto, valorExtras: $valorExtras, valorFaltas: $valorFaltas, valorAtraso: $valorAtraso, valorVendidaCaja: $valorVendidaCaja, bruto: $bruto");
            $request = new Request([
                'contrato_id' => $contrato->id,
                'user_id' => auth()->id() ?? 1,
                'sueldo' => $sueldoBase,
                'fijos' => $porcentajeFijos,
                'variables' => 0,
                'bruto' => $bruto,
                'extras' => $valorExtras,
                'extras_n' => $extras,
                'faltas' => $valorFaltas,
                'faltas_n' => $faltas,
                'atraso' => $valorAtraso,
                'atraso_n' => $atrasos,
                'venta' => $valorVendidaCaja,
                'desde' => trim($row['desde']),
                'hasta' => trim($row['hasta']),
                'venta_n' => $vendida,
                'valor_vacaciones' => 0,
                'adeuda' => $adeuda ?? 0,
                'plan' => $plan ?? null,
                'motivo_adeudo' => $motivo_adeudo ?? null,
                'cuotas' => [],             
                'pago_adeudos' => [],     
                'costos' => [],          
                'vacacionals' => [],      
                'observacion' => trim($row['observacion']),
            ]);

            try {
                app(\App\Http\Controllers\PlanillaController::class)->storeFromImport($request);
                $this->results['procesados']++;
                Log::info("Fila $fila: Planilla registrada correctamente.");
            } catch (\Exception $e) {
                $msg = "Fila $fila: Error interno al guardar planilla. " . $e->getMessage();
                Log::error($msg);
                $this->results['errores'][] = $msg;
            }
        }

        Log::info("Importación finalizada. Procesados: {$this->results['procesados']}. Errores: " . count($this->results['errores']));
    }




    public function getResults()
    {
        return $this->results;
    }
}
