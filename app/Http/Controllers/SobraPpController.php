<?php

namespace App\Http\Controllers;

use App\Models\DescomponerPt;
use App\Models\ItemsPt;
use App\Models\PtSobraPp;
use App\Models\SobraPp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SobraPpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SobraPp::where('estado',1)->get();
    }
    public function disponible()
    {
        return SobraPp::with(['Pp','SobraDetallePps'])->where([['estado',1],['aceptado',0]])->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sobraPp = new SobraPp();
        $sobraPp->name = $request->name;
        $sobraPp->save();
        return $sobraPp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SobraPp  $sobraPp
     * @return \Illuminate\Http\Response
     */
    public function show(SobraPp $sobraPp)
    {

        return $sobraPp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SobraPp  $sobraPp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SobraPp $sobraPp)
    {
        $sobraPp->name = $request->name;
        $sobraPp->save();
        return $sobraPp;
    }
    public function aceptarPt(Request $request, SobraPp $sobraPp)
    {
        $sobraPp->aceptado = 1;
        $sobraPp->save();
        $ptSobraPp = new PtSobraPp();
        $ptSobraPp->pt_id = $request->pt_nuevo_id;
        $ptSobraPp->sobra_pp_id = $sobraPp->id;
        $ptSobraPp->save();
        foreach ($sobraPp->sobraDetallePps as $sdp) {
            $itemsPt = new ItemsPt();
            $itemsPt->fecha = Carbon::now()->format('Y-m-d');
            $itemsPt->pt_id = $request->pt_nuevo_id;
            $itemsPt->item_id = $sdp->item_id;
            $itemsPt->cajas = $sdp->cajas;
            $itemsPt->taras = $sdp->peso_bruto - $sdp->peso_neto;
            $itemsPt->peso_bruto = $sdp->peso_bruto;
            $itemsPt->peso_neto = $sdp->peso_neto;
            $itemsPt->pp_emisor_id = $sobraPp->pp_id;
            $itemsPt->user_id = $sobraPp->user_id;
            $itemsPt->tipo = 1;
            $itemsPt->save();
        }
        return $sobraPp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SobraPp  $sobraPp
     * @return \Illuminate\Http\Response
     */
    public function destroy(SobraPp $sobraPp)
    {
        $sobraPp->estado = 0;
        $sobraPp->save();
    }
}
