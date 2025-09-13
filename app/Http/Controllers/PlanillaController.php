<?php

namespace App\Http\Controllers;

use App\Imports\PlanillasImport;
use App\Models\Adeuda;
use App\Models\Adeudacuota;
use App\Models\AdeudaPlanilla;
use App\Models\Finivacacional;
use App\Models\Finivacacionalplanilla;
use App\Models\Planilla;
use App\Models\Planillacosto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PlanillasExport;
use Maatwebsite\Excel\Facades\Excel;

class PlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contrato($id)
    {
        if ($id != "all") {
            $model = Planilla::with(['Contrato', 'Sucursal', 'User'])->where('contrato_id', $id)->get();
            $list = [];
            foreach ($model as $s) {
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->costos_1 = $s->Planillacostos()->where('monto', '>', 0)->sum('monto');
                $s->costos_2 = $s->Planillacostos()->where('monto', '<', 0)->sum('monto');
                $s->url_pdf = url("reportes/planillas/$s->id");
                $s->mes = $this->mes($s->desde);
                $list[] = $s;
            }
            return $list;
        } else {
            return $this->index();
        }
    }
    public function contratoFecha(Request $request, $id)
    {
        if ($id != "all") {
            $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
            $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');
            $model = Planilla::with(['Contrato', 'Sucursal', 'User'])->whereDate('fecha', '>=', $fecha_inicio)->whereDate('fecha', '<=', $fecha_fin)->where('contrato_id', $id)->get();
            $list = [];
            foreach ($model as $s) {
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->costos_1 = $s->Planillacostos()->where('monto', '>', 0)->sum('monto');
                $s->costos_2 = $s->Planillacostos()->where('monto', '<', 0)->sum('monto');
                $s->url_pdf = url("reportes/planillas/$s->id");
                $s->mes = $this->mes($s->desde);
                $list[] = $s;
            }
            return $list;
        } else {
            $fecha_inicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d');
            $fecha_fin = Carbon::parse($request->fecha_fin)->format('Y-m-d');
            $model = Planilla::with(['Contrato', 'Sucursal', 'User'])->whereDate('fecha', '>=', $fecha_inicio)->whereDate('fecha', '<=', $fecha_fin)->get();
            $list = [];
            foreach ($model as $s) {
                // $s->contrato->persona = $s->Contrato()->Persona();
                // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
                // $s->contrato->area = $s->Contrato()->Area();
                $s->costos_1 = $s->Planillacostos()->where('monto', '>', 0)->sum('monto');
                $s->costos_2 = $s->Planillacostos()->where('monto', '<', 0)->sum('monto');
                $s->url_pdf = url("reportes/planillas/$s->id");
                $s->mes = $this->mes($s->desde);
                $list[] = $s;
            }
            return $list;
        }
    }
    public function index()
    {
        $model = Planilla::with(['Contrato', 'Sucursal', 'User'])->get();
        $list = [];
        foreach ($model as $s) {
            // $s->contrato->persona = $s->Contrato()->Persona();
            // $s->contrato->tipocontrato = $s->Contrato()->Tipocontrato();
            // $s->contrato->area = $s->Contrato()->Area();
            $s->costos_1 = $s->Planillacostos()->where('monto', '>', 0)->sum('monto');
            $s->costos_2 = $s->Planillacostos()->where('monto', '<', 0)->sum('monto');
            $s->url_pdf = url("reportes/planillas/$s->id");
            $s->mes = $this->mes($s->desde);
            $list[] = $s;
        }
        return $list;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planilla = new Planilla();

        $planilla->observacion = $request->observacion;
        $planilla->contrato_id = $request->contrato_id;
        $planilla->fecha = date('Y-m-d');
        $planilla->fijos = $request->fijos;
        $planilla->user_id = $request->user_id;
        $planilla->sueldo = $request->sueldo;
        $planilla->variables = $request->variables;
        $planilla->bruto = $request->bruto;
        $planilla->extras = $request->valor_extra;
        $planilla->extras_n = $request->a_extras;
        $planilla->faltas = $request->valor_falta;
        $planilla->faltas_n = $request->a_falta;
        $planilla->atraso = $request->valor_atraso;
        $planilla->atraso_n = $request->a_atrasos;
        $planilla->venta = $request->vendido_caja;
        $planilla->desde = $request->desde;
        $planilla->hasta = $request->hasta;
        $planilla->venta_n = $request->a_vendida;
        $planilla->valor_vacaciones = $request->valor_vacaciones;

        $planilla->save();

        if (floatval($request->adeuda) > 0) {
            $adeuda = new Adeuda();
            $adeuda->monto = $request->adeuda;
            $adeuda->plan = $request->plan;
            $adeuda->motivo = $request->motivo_adeudo;
            $adeuda->planilla_id = $planilla->id;
            $adeuda->contrato_id = $request->contrato_id;
            $adeuda->fecha = date('Y-m-d');
            $adeuda->save();
            foreach ($request->cuotas as $c) {
                $adeudacuota = new Adeudacuota();
                $adeudacuota->adeuda_id = $adeuda->id;
                $adeudacuota->monto = $c['monto'];
                $adeudacuota->pagado = $c['estado'] == false ? 0 : 1;
                $adeudacuota->save();
            }
        }
        $adeudas = Adeuda::where([['contrato_id', $request->contrato_id], ['estado', 1]])->get();
        foreach ($adeudas as $a) {
            $AdeudaPlanilla = new AdeudaPlanilla();
            $AdeudaPlanilla->adeuda_id = $a->id;
            $AdeudaPlanilla->planilla_id = $planilla->id;
            $AdeudaPlanilla->save();
        }
        foreach ($request->pago_adeudos as $c) {
            $adeudacuota = Adeudacuota::find($c['id']);
            $adeudacuota->pagado = 1;
            $adeudacuota->save();

            $adeudacuotas = Adeudacuota::where([['pagado', 0], ['adeuda_id', $adeudacuota->adeuda_id]])->get();
            if ($adeudacuotas->count() == 0) {
                $adeuda = Adeuda::find($adeudacuota->adeuda_id);
                $adeuda->estado = 0;
                $adeuda->save();
            }
        }
        foreach ($request->costos as $c) {
            $Planillacosto = new Planillacosto();
            $Planillacosto->planilla_id = $planilla->id;
            $Planillacosto->costovariable_id = $c['costo']['id'];
            $Planillacosto->monto = $c['monto'];
            $Planillacosto->save();
        }
        foreach ($request->vacacionals as $c) {
            $finivacacional = Finivacacional::find($c['id']);


            $finivacacional->planilla = 0;


            $finivacacional->save();
            $finivacacionalplanilla = new Finivacacionalplanilla();


            $finivacacionalplanilla->finivacacional_id = $c['id'];
            $finivacacionalplanilla->planilla_id = $planilla->id;
            $finivacacionalplanilla->pago = $c['pago'];

            $finivacacionalplanilla->save();
        }
        $planilla->url_pdf = url("reportes/planillas/$planilla->id");
        return $planilla;
    }

    public function storeFromImport(Request $request)
    {
        $planilla = new Planilla();

        // Campos básicos
        $planilla->observacion = $request->observacion ?? null;
        $planilla->contrato_id = $request->contrato_id;
        $planilla->fecha = date('Y-m-d');
        $planilla->fijos = $request->fijos;
        $planilla->user_id = $request->user_id;
        $planilla->sueldo = $request->sueldo;
        $planilla->variables = $request->variables ?? 0;
        $planilla->bruto = $request->bruto ?? 0;

        // Usar nombres correctos para extras, faltas, atraso y venta
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
        $planilla->valor_vacaciones = $request->valor_vacaciones ?? 0;
        $planilla->observacion = $request->observacion ?? null;
        
        $planilla->save();

        // Manejar adeudos si hay monto adeuda
        if (
            is_numeric($request->adeuda) && floatval($request->adeuda) > 0 &&
            is_numeric($request->plan) && intval($request->plan) > 0 &&
            !empty(trim($request->motivo_adeudo))
        ) {
            $adeuda = new Adeuda();
            $adeuda->monto = $request->adeuda;
            $adeuda->plan = $request->plan;
            $adeuda->motivo = $request->motivo_adeudo;
            $adeuda->planilla_id = $planilla->id;
            $adeuda->contrato_id = $request->contrato_id;
            $adeuda->fecha = date('Y-m-d');
            $adeuda->save();

            $montoPorCuota = round($adeuda->monto / $adeuda->plan, 3);
            for ($i = 1; $i <= $adeuda->plan; $i++) {
                $adeudacuota = new Adeudacuota();
                $adeudacuota->adeuda_id = $adeuda->id;
                $adeudacuota->monto = $montoPorCuota;
                $adeudacuota->pagado = 0;
                $adeudacuota->estado = 1;
                $adeudacuota->save();
            }
        }

        // Relacionar adeudas activas a la planilla
        $adeudas = Adeuda::where([
            ['contrato_id', $request->contrato_id],
            ['estado', 1]
        ])->get();

        foreach ($adeudas as $a) {
            $adeudaPlanilla = new AdeudaPlanilla();
            $adeudaPlanilla->adeuda_id = $a->id;
            $adeudaPlanilla->planilla_id = $planilla->id;
            $adeudaPlanilla->save();
        }

        // Marcar cuotas pagadas si las envías en pago_adeudos
        if (!empty($request->pago_adeudos) && is_array($request->pago_adeudos)) {
            foreach ($request->pago_adeudos as $c) {
                $adeudacuota = Adeudacuota::find($c['id']);
                if ($adeudacuota) {
                    $adeudacuota->pagado = 1;
                    $adeudacuota->save();

                    $adeudacuotas = Adeudacuota::where([
                        ['pagado', 0],
                        ['adeuda_id', $adeudacuota->adeuda_id]
                    ])->get();

                    if ($adeudacuotas->count() == 0) {
                        $adeuda = Adeuda::find($adeudacuota->adeuda_id);
                        $adeuda->estado = 0;
                        $adeuda->save();
                    }
                }
            }
        }

        // Guardar costos variables si se envían
        if (!empty($request->costos) && is_array($request->costos)) {
            foreach ($request->costos as $c) {
                $planillacosto = new Planillacosto();
                $planillacosto->planilla_id = $planilla->id;
                $planillacosto->costovariable_id = $c['costo']['id'] ?? null;
                $planillacosto->monto = $c['monto'] ?? 0;
                $planillacosto->save();
            }
        }

        // Vacacionales
        if (!empty($request->vacacionals) && is_array($request->vacacionals)) {
            foreach ($request->vacacionals as $c) {
                $finivacacional = Finivacacional::find($c['id']);
                if ($finivacacional) {
                    $finivacacional->planilla = 0;
                    $finivacacional->save();

                    $finivacacionalplanilla = new Finivacacionalplanilla();
                    $finivacacionalplanilla->finivacacional_id = $c['id'];
                    $finivacacionalplanilla->planilla_id = $planilla->id;
                    $finivacacionalplanilla->pago = $c['pago'] ?? 0;
                    $finivacacionalplanilla->save();
                }
            }
        }

        $planilla->save();

        return $planilla;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show(Planilla $planilla)
    {
        $planilla->user = $planilla->User;
        $planilla->sucursal = $planilla->Sucursal;
        // $planilla->sucursal->image = $planilla->sucursal->imagesucursal->File();
        // $planilla->sucursal->image->url = url_path().$planilla->sucursal->image->path;
        $planilla->sucursal->file_sucursals = $planilla->sucursal->Filesucursals()->get()->each(function ($file) {
            $file->path_url = url($file->File->path);
        });
        $planilla->sucursal->image = $planilla->sucursal->file_sucursals->first();
        $planilla->contrato = $planilla->Contrato;
        $planilla->contrato->adeudas_detalles = $planilla->contrato->Adeudas()->get();
        $planilla->planilla_costos = $planilla->Planillacostos()->get();
        $planilla->adeudas_bool = false;

        $adeudas_detalles = $planilla->AdeudaPlanillas()->get();
        $planilla->adeudas_detalles = [];
        if ($adeudas_detalles->count() > 0) {
            $planilla->adeudas_bool = true;
            $planilla->adeudas_detalles = $planilla->AdeudaPlanillas()->get();
        }
        $planilla->mes = $this->mes($planilla->desde);
        $planilla->emision = Carbon::now()->format('Y-m-d h:i:s');
        $sum = 0;
        foreach ($planilla->contrato->Contratocostos()->get() as $c) {
            $c->costofijo = $c->Costofijo;
            $sum += floatval($c->costofijo->monto);
        }

        $planilla->contrato->contratocostos_sum = $sum;

        return $planilla;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planilla $planilla)
    {
        $planilla->name = $request->name;
        $planilla->save();
        return $planilla;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planilla $planilla)
    {
        $planilla->estado = 0;
        $planilla->save();
    }
    public function pdf(Planilla $planilla)
    {
        $planilla = $this->show($planilla);

        $pdf = Pdf::loadView('reportes.pdf.planilla', ["planilla" => $planilla]);
        return $pdf->stream();
    }

    public function TemplateExcel()
    {
        $fileName = 'planilla_template' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PlanillasExport, $fileName);
    }


    public function ImportarExcel(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
        ]);

        $import = new PlanillasImport();
        Excel::import($import, $request->file('excel'));

        $results = $import->getResults();

        return response()->json([
            'imported' => $results['procesados'],
            'errors' => $results['errores'],
        ]);
    }
}
