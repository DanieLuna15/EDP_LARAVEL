<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Planillaservicio;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Planillaserviciocosto;
use App\Imports\PlanillasServicioImport;
use App\Exports\PlanillasServicioExport;
use Illuminate\Support\Facades\Log;
class PlanillaservicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contrato($id)
    {
        if ($id != "all") {
            $model = Planillaservicio::with(['Contrato', 'Planillaserviciocostos', 'Sucursal', 'User'])->where('contrato_id', $id)->get();
            $list = [];
            foreach ($model as $s) {
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->costos_1 = $s->Planillaserviciocostos()->where('monto', '>', 0)->sum('monto');
                $s->costos_2 = $s->Planillaserviciocostos()->where('monto', '<', 0)->sum('monto');
                $s->url_pdf = url("reportes/planillaservicios/$s->id");
                $s->mes = $this->mes($s->desde);
                $list[] = $s;
            }
            return $list;
        } else {
            return $this->index();
        }
    }
public function index()
{
    // Registrar cuando se llama al método
    Log::info('Se ha llamado al método index de PlanillaServicio.');

    // Obtener el modelo de Planillaservicio con sus relaciones
    $model = Planillaservicio::with(['Contrato', 'Planillaserviciocostos', 'Sucursal', 'User'])->get();

    // Registrar los datos obtenidos del modelo
    Log::info('Se obtuvieron los datos de Planillaservicio', ['model' => $model]);

    $list = [];
    
    foreach ($model as $s) {
        // Registrar el procesamiento de cada PlanillaServicio
        Log::info('Procesando PlanillaServicio', ['planilla' => $s]);

        // Calcular los costos y registrar los cálculos
        $costos_1 = $s->Planillaserviciocostos()->where('monto', '>', 0)->sum('monto');
        $costos_2 = $s->Planillaserviciocostos()->where('monto', '<', 0)->sum('monto');
        
        // Registrar los costos calculados
        Log::info('Cálculo de costos realizado', ['costos_1' => $costos_1, 'costos_2' => $costos_2]);

        $s->costos_1 = $costos_1;
        $s->costos_2 = $costos_2;

        // Registrar la generación de la URL para el PDF
        $url_pdf = url("reportes/planillaservicios/$s->id");
        Log::info('Se generó la URL para el PDF', ['url_pdf' => $url_pdf]);
        $s->url_pdf = $url_pdf;

        // Calcular el mes a partir de 'desde' y registrar el valor
        $mes = $this->mes($s->desde);
        Log::info('Cálculo del mes realizado', ['mes' => $mes]);
        $s->mes = $mes;

        // Añadir la PlanillaServicio al listado
        $list[] = $s;
    }

    // Registrar el listado final que se va a devolver
    Log::info('Listado final de Planillaservicio', ['list' => $list]);

    return $list;
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planillaservicio = new Planillaservicio();
        $planillaservicio->observacion = $request->observacion;
        $planillaservicio->contrato_id = $request->contrato_id;
        $planillaservicio->fecha = date('Y-m-d');
        $planillaservicio->fijos = $request->fijos;
        $planillaservicio->user_id = $request->user_id;
        $planillaservicio->desde = $request->desde;
        $planillaservicio->hasta = $request->hasta;
        $planillaservicio->motivo = $request->motivo;
        $planillaservicio->horas = $request->horas;
        $planillaservicio->valor_horas = $request->horas_valor;
        $planillaservicio->sueldo = $request->sueldo;
        $planillaservicio->variables = $request->variables;
        $planillaservicio->bruto = $request->bruto;
        $planillaservicio->extras = $request->valor_extra;
        $planillaservicio->extras_n = $request->a_extras;
        $planillaservicio->faltas = $request->valor_falta;
        $planillaservicio->faltas_n = $request->a_falta;
        $planillaservicio->atraso = $request->valor_atraso;
        $planillaservicio->atraso_n = $request->a_atrasos;
        $planillaservicio->venta = $request->vendido_caja;
        $planillaservicio->desde = $request->desde;
        $planillaservicio->hasta = $request->hasta;
        $planillaservicio->venta_n = $request->a_vendida;

        $planillaservicio->save();



        foreach ($request->costos as $c) {
            $Planillaserviciocosto = new Planillaserviciocosto();
            $Planillaserviciocosto->planillaservicio_id = $planillaservicio->id;
            $Planillaserviciocosto->costovariable_id = $c['costo']['id'];
            $Planillaserviciocosto->monto = $c['monto'];
            $Planillaserviciocosto->save();
        }

        $planillaservicio->url_pdf = url("reportes/planillaservicios/$planillaservicio->id");
        return $planillaservicio;
    }
    public function mes($fecha)
    {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        $val = $mes . ' de ' . $fecha->format('Y');
        return $val;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planillaservicio  $planillaservicio
     * @return \Illuminate\Http\Response
     */
    public function show(Planillaservicio $planillaservicio)
    {
        $planillaservicio->sucursal->file_sucursals = $planillaservicio->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $planillaservicio->sucursal->image = $planillaservicio->sucursal->file_sucursals->first();
        $planillaservicio->emision = Carbon::now()->format('Y-m-d h:i:s');
        return $planillaservicio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planillaservicio  $planillaservicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planillaservicio $planillaservicio)
    {
        $planillaservicio->name = $request->name;
        $planillaservicio->save();
        return $planillaservicio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planillaservicio  $planillaservicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planillaservicio $planillaservicio)
    {
        $planillaservicio->estado = 0;
        $planillaservicio->save();
    }
    public function pdf(Planillaservicio $planillaservicio)
    {
        $planilla = $this->show($planillaservicio);

        $pdf = Pdf::loadView('reportes.pdf.planillaservicio', ["planilla" => $planilla]);
        return $pdf->stream();
    }


    public function TemplateExcel()
    {
        $fileName = 'planilla_template' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PlanillasServicioExport, $fileName);
    }


    public function ImportarExcel(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
        ]);

        $import = new PlanillasServicioImport();
        Excel::import($import, $request->file('excel'));

        $results = $import->getResults();

        return response()->json([
            'imported' => $results['procesados'],
            'errors' => $results['errores'],
        ]);
    }

    public function storeFromImport(Request $request)
    {
        $planilla = new Planillaservicio();

        // Campos básicos
        $planilla->contrato_id = $request->contrato_id;
        $planilla->fecha = date('Y-m-d');
        $planilla->fijos = $request->fijos;
        $planilla->user_id = $request->user_id;
        $planilla->sueldo = $request->sueldo;
        $planilla->variables = $request->variables ?? 0;
        $planilla->bruto = $request->bruto ?? 0;

        $planilla->motivo = $request->motivo;

        $planilla->horas = $request->horas ?? 0;
        $planilla->valor_horas = $request->valor_horas ?? 0;

        $planilla->extras = $request->extras ?? 0;
        $planilla->extras_n = $request->extras_n ?? 0;
        $planilla->faltas = $request->faltas ?? 0;
        $planilla->faltas_n = $request->faltas_n ?? 0;
        $planilla->atraso = $request->atraso ?? 0;
        $planilla->atraso_n = $request->atraso_n ?? 0;
        $planilla->venta = $request->venta ?? 0;
        $planilla->venta_n = $request->venta_n ?? 0;
        $planilla->desde = $request->desde;
        $planilla->hasta = $request->hasta;
        $planilla->observacion = $request->observacion ?? null;

        $planilla->save();

        // Guardar costos variables si se envían
        if (!empty($request->costos) && is_array($request->costos)) {
            foreach ($request->costos as $c) {
                $Planillaserviciocosto = new Planillaserviciocosto();
                $Planillaserviciocosto->planillaservicio_id = $planilla->id;
                $Planillaserviciocosto->costovariable_id = $c['costo']['id'] ?? null;
                $Planillaserviciocosto->monto = $c['monto'] ?? 0;
                $Planillaserviciocosto->save();
            }
        }

        return $planilla;
    }
}
