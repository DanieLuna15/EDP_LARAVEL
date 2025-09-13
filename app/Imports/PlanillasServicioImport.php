<?php

namespace App\Imports;

use App\Models\Contrato;
use App\Models\CogPlanilla;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;

class PlanillasServicioImport implements ToCollection, WithHeadingRow
{
    protected $results = [
        'procesados' => 0,
        'errores' => [],
    ];

    public function collection(Collection $rows)
    {
        Log::info("Inicio importación de planillas servicios. Total filas: " . count($rows));

        $cogplanilla = CogPlanilla::where('estado', 1)->first();

        if (!$cogplanilla) {
            Log::error("No se encontró configuración activa en cogplanillas.");
            return;
        }

        foreach ($rows as $index => $row) {
            $fila = $index + 2;
            Log::info("Procesando fila $fila: " . json_encode($row));

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
            $motivo = $row['motivo'] ?? '';
            $horas = is_numeric($row['horas']) ? (float)$row['horas'] : 0;
            $horas_valor = is_numeric($row['valor_horas']) ? (float)$row['valor_horas'] : 0;

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

            $bruto = round($sueldoBruto + $valorExtras + $valorVendidaCaja + $valorFaltas + $valorAtraso + ($horas * $horas_valor), 2);

            Log::info("Fila $fila: sueldoBase: $sueldoBase, sueldoBruto: $sueldoBruto, valorExtras: $valorExtras, valorFaltas: $valorFaltas, valorAtraso: $valorAtraso, valorVendidaCaja: $valorVendidaCaja, horas: $horas, valorHoras: $horas_valor, bruto: $bruto");

            $request = new Request([
                'contrato_id' => $contrato->id,
                'user_id' => auth()->id() ?? 1,
                'sueldo' => $sueldoBase,
                'fijos' => $porcentajeFijos,
                'variables' => 0,
                'bruto' => $bruto,
                'motivo' => $motivo,
                'horas' => $horas,
                'valor_horas' => $horas_valor,
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
                'observacion' => trim($row['observacion']),
            ]);

            Log::info("Fila $fila - Datos de request para guardar planilla servicio: " . json_encode($request->all()));
            Log::info("Fila $fila - valor_horas recibido: " . $request->valor_horas);


            try {
                app(\App\Http\Controllers\PlanillaservicioController::class)->storeFromImport($request);
                $this->results['procesados']++;
                Log::info("Fila $fila: Planilla servicio registrada correctamente.");
            } catch (\Exception $e) {
                $msg = "Fila $fila: Error interno al guardar planilla servicio. " . $e->getMessage();
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
