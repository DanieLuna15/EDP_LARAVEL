<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\Tipopago;
use App\Models\Documento;
use App\Models\FormaPedido;
use App\Models\Tipocliente;
use App\Models\TipoNegocio;
use App\Models\CintaCliente;
use App\Models\ZonaDespacho;
use App\Models\TipoClientePp;
use App\Models\AcuerdoCliente;
use Illuminate\Support\Carbon;
use App\Models\CajacerradaCliente;
use App\Models\TipoClientePpLimpio;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class ClienteImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     if ($row[0] != 'NOMBRE') {

    //         // Reemplazamos get() por first() para obtener solo el primer resultado
    //         $Documento = Documento::where([['name', $row[1]], ['estado', true]])->first();
    //         $Tipocliente = Tipocliente::where([['name', $row[4]], ['estado', true]])->first();
    //         $Tipopago = Tipopago::where([['name', $row[24]], ['estado', true]])->first();
    //         $CintaCliente = CintaCliente::where([['name', $row[13]], ['estado', true]])->first();
    //         $AcuerdoCliente = AcuerdoCliente::where([['name', $row[18]], ['estado', true]])->first();
    //         $TipoclientePp = TipoClientePp::where([['name', $row[22]], ['estado', true]])->first();
    //         $TipoclientePpLimpio = TipoClientePpLimpio::where([['name', $row[23]], ['estado', true]])->first();
    //         $CajacerradaCliente = CajacerradaCliente::where([['name', $row[19]], ['estado', true]])->first();

    //         // Mapeamos los tipos de pollo limpio
    //         $tipos  = [
    //             "DE 1 A 14 POLLOS" => "1",
    //             "OFICIAL (15 A 75 POLLOS)" => "2",
    //             "DE 76 A 150 POLLOS" => "3",
    //             "DE 151 A MAS POLLOS" => "4",
    //             "CUALQUIER CANTIDAD AL CONTADO" => "5",
    //             "VIP" => "6",
    //         ];

    //         $tipoPolloLimpio = $tipos[$row[17]];

    //         // Crear el cliente
    //         $cliente = new Cliente();
    //         $cliente->nombre = $row[0];
    //         $cliente->documento_id = $Documento ? $Documento->id : null;  // Asegúrate de que el documento exista
    //         $cliente->doc = $row[2];
    //         $cliente->estado = $row[3] == 'SI' ? 1 : 0;
    //         $cliente->tipopago_id = $Tipopago ? $Tipopago->id : null;  // Asegúrate de que el tipo de pago exista
    //         $cliente->tipocliente_id = $Tipocliente ? $Tipocliente->id : null;  // Asegúrate de que el tipo de cliente exista
    //         $cliente->cinta_cliente_id = $CintaCliente ? $CintaCliente->id : null;  // Asegúrate de que la cinta cliente exista
    //         $cliente->telefono = $row[5];
    //         $cliente->direccion = $row[6];
    //         $cliente->correo = $row[7];
    //         $cliente->limite_crediticio = $row[8];
    //         $cliente->creditos_activos = $row[9];
    //         $cliente->dias_horas = $row[10];
    //         $cliente->latitud = $row[11];
    //         $cliente->longitud = $row[12];
    //         $cliente->dinero_cuenta = $row[14];
    //         $cliente->deuda_heredada = $row[15];
    //         $cliente->interes = $row[16];
    //         $cliente->tipo_pollo_limpia = $tipoPolloLimpio;
    //         $cliente->acuerdo_cliente_id = $AcuerdoCliente ? $AcuerdoCliente->id : null;  // Asegúrate de que el acuerdo cliente exista
    //         $cliente->cajacerrada_cliente_id = $CajacerradaCliente ? $CajacerradaCliente->id : null;  // Asegúrate de que la caja cerrada cliente exista
    //         $cliente->aprobado = $row[20] == 'SI' ? 1 : 0;
    //         $cliente->activo = $row[21] == 'SI' ? 1 : 0;
    //         $cliente->tipo_cliente_pp = $TipoclientePp ? $TipoclientePp->id : null;  // Asegúrate de que el tipo cliente pp exista
    //         $cliente->tipo_cliente_pp_limpio_id = $TipoclientePpLimpio ? $TipoclientePpLimpio->id : null;  // Asegúrate de que el tipo cliente pp limpio exista
    //         $cliente->tipo_caja_cerrada = $CajacerradaCliente ? $CajacerradaCliente->id : null;  // Asegúrate de que la caja cerrada cliente exista
    //         $cliente->caja_cerrada = $row[25] == 'SI' ? 1 : 0;
    //         $cliente->iva = $row[26];
    //         $cliente->is_iva = $row[27] == 'SI' ? 1 : 0;

    //         // Nuevos campos
    //         $cliente->tipo_pt = $row[28];
    //         $cliente->tipo_trans = $row[29];
    //         $cliente->preventista_id = $row[30];

    //         // Guardar el cliente
    //         $cliente->save();

    //         return $cliente;
    //     }
    // }


    //     public function model(array $row)
    // {
    //     // Log para verificar el contenido de la fila
    //     Log::info("Importando cliente: ", $row);

    //     if($row[0] != 'NOMBRE'){
    //         try {
    //             // Obtener los registros relacionados
    //             $Documento = Documento::where([['name', $row[1]], ['estado', true]])->first();
    //             $Tipocliente = Tipocliente::where([['name', $row[4]], ['estado', true]])->first();
    //             $Tipopago = Tipopago::where([['name', $row[24]], ['estado', true]])->first();
    //             $CintaCliente = CintaCliente::where([['name', $row[13]], ['estado', true]])->first();
    //             $AcuerdoCliente = AcuerdoCliente::where([['name', $row[18]], ['estado', true]])->first();
    //             $TipoclientePp = TipoClientePp::where([['name', $row[22]], ['estado', true]])->first();
    //             $TipoclientePpLimpio = TipoClientePpLimpio::where([['name', $row[23]], ['estado', true]])->first();
    //             $CajacerradaCliente = CajacerradaCliente::where([['name', $row[19]], ['estado', true]])->first();

    //             // Verificar que todos los registros estén presentes
    //             if (!$Documento || !$Tipocliente || !$Tipopago || !$CintaCliente || !$AcuerdoCliente || !$TipoclientePp || !$TipoclientePpLimpio || !$CajacerradaCliente) {
    //                 Log::error("Error: Faltan datos de referencia para el cliente: ", $row);
    //                 return null; // Si falta algún dato relacionado, no guardar este cliente
    //             }

    //             // Mapeo de tipos de pollo limpio
    //             $tipos  = [
    //                 "DE 1 A 14 POLLOS" => "1",
    //                 "OFICIAL (15 A 75 POLLOS)" => "2",
    //                 "DE 76 A 150 POLLOS" => "3",
    //                 "DE 151 A MAS POLLOS" => "4",
    //                 "CUALQUIER CANTIDAD AL CONTADO" => "5",
    //                 "VIP" => "6",
    //             ];

    //             $tipoPolloLimpio = $tipos[$row[17]] ?? null;

    //             // Crear el cliente
    //             $cliente = new Cliente();
    //             $cliente->nombre = $row[0];
    //             $cliente->documento_id = $Documento->id;
    //             $cliente->doc = $row[2];
    //             $cliente->estado = $row[3] == 'SI' ? 1 : 0;
    //             $cliente->tipopago_id = $Tipopago->id;
    //             $cliente->tipocliente_id = $Tipocliente->id;
    //             $cliente->cinta_cliente_id = $CintaCliente->id;
    //             $cliente->telefono = $row[5];
    //             $cliente->direccion = $row[6];
    //             $cliente->correo = $row[7];
    //             $cliente->limite_crediticio = $row[8];
    //             $cliente->creditos_activos = $row[9];
    //             $cliente->dias_horas = $row[10];
    //             $cliente->latitud = $row[11];
    //             $cliente->longitud = $row[12];
    //             $cliente->dinero_cuenta = $row[14];
    //             $cliente->deuda_heredada = $row[15];
    //             $cliente->interes = $row[16];
    //             $cliente->tipo_pollo_limpia = $tipoPolloLimpio;
    //             $cliente->acuerdo_cliente_id = $AcuerdoCliente->id;
    //             $cliente->cajacerrada_cliente_id = $CajacerradaCliente->id;
    //             $cliente->aprobado = $row[20] == 'SI' ? 1 : 0;
    //             $cliente->activo = $row[21] == 'SI' ? 1 : 0;
    //             $cliente->tipo_cliente_pp = $TipoclientePp->id;
    //             $cliente->tipo_cliente_pp_limpio_id = $TipoclientePpLimpio->id;
    //             $cliente->tipo_caja_cerrada = $CajacerradaCliente->id;
    //             $cliente->caja_cerrada = $row[25] == 'SI' ? 1 : 0;
    //             $cliente->iva = $row[26];
    //             $cliente->is_iva = $row[27] == 'SI' ? 1 : 0;

    //             // Nuevos campos
    //             $cliente->tipo_pt = $row[28];
    //             $cliente->tipo_trans = $row[29];
    //             $cliente->preventista_id = $row[30];

    //             // Guardar el cliente
    //             $cliente->save();

    //             Log::info("Cliente importado exitosamente: " . $cliente->id);
    //             return $cliente;
    //         } catch (\Exception $e) {
    //             Log::error("Error al importar cliente: " . $e->getMessage());
    //             return null;
    //         }
    //     }

    //     return null;
    // }



    // public function model(array $row)
    // {
    //     // Log para ver qué fila se está procesando
    //     Log::info("Importando cliente: ", $row);

    //     if ($row[0] != 'NOMBRE') {

    //         // Obtener los registros relacionados y agregar más detalles en los logs
    //         $Documento = Documento::where([['name', $row[1]], ['estado', true]])->first();
    //         //$Tipocliente = Tipocliente::where([['name', $row[4]], ['estado', true]])->first();
    //         // $Tipopago = Tipopago::where([['name', $row[24]], ['estado', true]])->first();
    //         // $CintaCliente = CintaCliente::where([['name', $row[13]], ['estado', true]])->first();
    //         // $AcuerdoCliente = AcuerdoCliente::where([['name', $row[18]], ['estado', true]])->first();
    //         // $TipoclientePp = TipoClientePp::where([['name', $row[22]], ['estado', true]])->first();
    //         // $TipoclientePpLimpio = TipoClientePpLimpio::where([['name', $row[23]], ['estado', true]])->first();
    //         // $CajacerradaCliente = CajacerradaCliente::where([['name', $row[19]], ['estado', true]])->first();

    //         // Log para verificar si se encontraron los registros relacionados
    //         if (!$Documento) Log::error("Documento no encontrado para: " . $row[1]);
    //         //if (!$Tipocliente) Log::error("Tipo de cliente no encontrado para: " . $row[4]);
    //         // if (!$Tipopago) Log::error("Tipo de pago no encontrado para: " . $row[24]);
    //         // if (!$CintaCliente) Log::error("Cinta cliente no encontrada para: " . $row[13]);
    //         // if (!$AcuerdoCliente) Log::error("Acuerdo cliente no encontrado para: " . $row[18]);
    //         // if (!$TipoclientePp) Log::error("Tipo cliente PP no encontrado para: " . $row[22]);
    //         // if (!$TipoclientePpLimpio) Log::error("Tipo cliente PP limpio no encontrado para: " . $row[23]);
    //         // if (!$CajacerradaCliente) Log::error("Caja cerrada cliente no encontrada para: " . $row[19]);

    //         // Si alguno de los registros falta, no guardamos el cliente
    //         if (!$Documento  /* ||  !$Tipocliente ||  !$Tipopago || !$CintaCliente || !$AcuerdoCliente || !$TipoclientePp || !$TipoclientePpLimpio || !$CajacerradaCliente*/) {
    //             Log::error("Error: Faltan datos de referencia para el cliente: ", $row);
    //             return null; // Si falta algún dato relacionado, no guardar este cliente
    //         }

    //         // Mapeo de tipos de pollo limpio
    //         $tipos  = [
    //             "" => "0",
    //             "POR MAYOR" => "1",
    //             "OFERTA" => "2",
    //             "LOQUIDACION" => "3",
    //             "C/FACTURA" => "4",
    //             "SUCURSAL" => "5",
    //         ];

    //         $tipoPolloLimpio = $tipos[$row[17]] ?? 0;
    //         $tipoCajaCerrada = $tipos[$row[19]] ?? 0;
    //         $tipoPT = $tipos[$row[28]] ?? 0;
    //         $tipoTrans = $tipos[$row[29]] ?? 0;


    //         // Crear el cliente
    //         $cliente = new Cliente();
    //         $cliente->nombre = $row[0];
    //         $cliente->documento_id = $Documento ? $Documento->id : null;
    //         $cliente->doc = $row[2];
    //         $cliente->estado = $row[3] == 'SI' ? 1 : 0;
    //         $cliente->tipopago_id = $row[24] ?: 1;
    //         $cliente->tipocliente_id = $row[4] ?: 1;
    //         $cliente->cinta_cliente_id = $row[13] ?: 1;
    //         $cliente->telefono = $row[5];
    //         $cliente->direccion = $row[6];
    //         $cliente->correo = $row[7];
    //         $cliente->limite_crediticio = $row[8];
    //         $cliente->creditos_activos = $row[9];
    //         $cliente->dias_horas = $row[10];
    //         $cliente->latitud = $row[11];
    //         $cliente->longitud = $row[12];
    //         $cliente->dinero_cuenta = $row[14];
    //         $cliente->deuda_heredada = $row[15];
    //         $cliente->interes = $row[16];
    //         $cliente->tipo_pollo_limpia = $tipoPolloLimpio;
    //         $cliente->acuerdo_cliente_id = $row[18] ?: 1;
    //         $cliente->cajacerrada_cliente_id = $row[19] ?: 1;
    //         $cliente->aprobado = $row[20] == 'SI' ? 1 : 0;
    //         $cliente->activo = $row[21] == 'SI' ? 1 : 0;
    //         $cliente->tipo_cliente_pp = $row[22] ?: 1;
    //         $cliente->tipo_cliente_pp_limpio_id = $row[23] ?: 1;
    //         $cliente->tipo_caja_cerrada = $tipoCajaCerrada  ?: 0;
    //         $cliente->caja_cerrada = $row[25] == 'SI' ? 1 : 0;
    //         $cliente->iva = $row[26];
    //         $cliente->is_iva = $row[27] == 'SI' ? 1 : 0;

    //         // Nuevos campos
    //         $cliente->tipo_pt = $tipoPT ?: 0;
    //         $cliente->tipo_trans = $tipoTrans ?: 0;
    //         $cliente->preventista_id = $row[30];

    //         // Guardar el cliente
    //         $cliente->save();

    //         // Log de éxito
    //         Log::info("Cliente importado exitosamente: " . $cliente->id);
    //         return $cliente;
    //     }

    //     return null;
    // }


    // public function model(array $row)
    // {
    //     Log::info("Importando cliente: ", $row);

    //     if ($row[0] != 'NOMBRE') {
    //         $Documento = Documento::where([['name', $row[1]], ['estado', 1]])->first();
    //         $Tipocliente = Tipocliente::where([['name', $row[3]], ['estado', 1]])->first();
    //         $GrupoCliente = CintaCliente::where([['name', $row[4]], ['estado', 1]])->first();            
    //         $Preventista = User::where([['name', $row[23]], ['estado', 1]])->first();
    //         $AcuerdoCliente = AcuerdoCliente::where([['name', $row[24]], ['estado', 1]])->first();
    //         $Tipopago = Tipopago::where([['name', $row[25]], ['estado', 1]])->first();
    //         $TipoNegocio = TipoNegocio::where([['name', $row[26]], ['estado', 1]])->first();
    //         $FormaPedido = FormaPedido::where([['name', $row[27]], ['estado', 1]])->first();    
    //         $Chofer = Chofer::where([['name', $row[28]], ['estado', 1]])->first();
    //         $ZonaDespacho = ZonaDespacho::where([['name', $row[29]], ['estado', 1]])->first();


    //         if (!$Documento) Log::error("Documento no encontrado para: " . $row[1]);

    //         if (!$Documento ) {
    //             Log::error("Error: Faltan datos de referencia para el cliente: ", $row);
    //             return null;
    //         }

    //         $tipos  = [
    //             "" => "0",
    //             "POR MAYOR" => "5",
    //             "OFERTA" => "6",
    //             "LOQUIDACION" => "7",
    //             "C/FACTURA" => "8",
    //             "SUCURSAL" => "9",
    //         ];

    //         $tipoCajaCerrada = $tipos[$row[19]] ?? 0;
    //         $tipoPolloLimpio = $tipos[$row[20]] ?? 0;
    //         $tipoPT = $tipos[$row[21]] ?? 0;
    //         $tipoTrans = $tipos[$row[22]] ?? 0;

    //         $cliente = new Cliente();
    //         $cliente->nombre = $row[0];
    //         $cliente->documento_id = $Documento ? $Documento->id : 1;
    //         $cliente->doc = $row[2];

    //         $cliente->tipocliente_id = $Tipocliente->id ?: 1;
    //         $cliente->cinta_cliente_id = $GrupoCliente->id ?: 0;
    //         $cliente->caja_cerrada = $row[5] == 'SI' ? 1 : 0;

    //         $cliente->telefono = $row[6];
    //         $cliente->direccion = $row[7];
    //         $cliente->correo = $row[8];


    //         $cliente->limite_crediticio = $row[9];
    //         $cliente->creditos_activos = $row[10];
    //         $cliente->dias_horas = $row[11];

    //         $cliente->latitud = $row[12];
    //         $cliente->longitud = $row[13];

    //         $cliente->horario_preferencia = $row[14];
    //         $cliente->horario_pedido = $row[15];
    //         $cliente->dinero_cuenta = $row[16];
    //         $cliente->deuda_heredada = $row[17];
    //         $cliente->interes = $row[18];

    //         $cliente->tipo_pollo_limpia = $tipoPolloLimpio ?: 0;
    //         $cliente->tipo_caja_cerrada = $tipoCajaCerrada  ?: 0;
    //         $cliente->tipo_pt = $tipoPT ?: 0;
    //         $cliente->tipo_trans = $tipoTrans ?: 0;

    //         $cliente->preventista_id = $Preventista->id ?: 1;
    //         $cliente->acuerdo_cliente_id = $AcuerdoCliente->id ?: 1;
    //         $cliente->tipopago_id = $Tipopago->id ?: 1;
    //         $cliente->tipo_negocio_id = $TipoNegocio->id ?: 1;
    //         $cliente->forma_pedido_id = $FormaPedido->id ?: 1;
    //         $cliente->chofer_id = $Chofer->id ?: 1;
    //         $cliente->zona_despacho_id = $ZonaDespacho->id ?: 1;

    //         $cliente->is_iva = $row[31] == 'SI' ? 1 : 0;
    //         if ($row[31] == 'SI') {
    //             $cliente->iva = $row[30];
    //         }
    //         else {
    //             $cliente->iva = 30;
    //         }

    //         $cliente->estado = $row[32] == 'SI' ? 1 : 0;
    //         $cliente->aprobado = $row[33] == 'SI' ? 1 : 0;
    //         $cliente->activo = $row[34] == 'SI' ? 1 : 0;

    //         $cliente->save();

    //         return $cliente;
    //     }

    //     return null;
    // }


public function model(array $row)
{
    // Listado de errores para cada fila
    static $allErrors = [];

    try {
        // Realiza las validaciones
        $errors = [];

        $Documento = Documento::where([['name', $row[1]], ['estado', 1]])->first();
        $Tipocliente = Tipocliente::where([['name', $row[3]], ['estado', 1]])->first();
        $GrupoCliente = CintaCliente::where([['name', $row[4]], ['estado', 1]])->first();
        $Preventista = User::where([['nombre', $row[23]], ['estado', 1]])->first();
        $AcuerdoCliente = AcuerdoCliente::where([['name', $row[24]], ['estado', 1]])->first();
        $Tipopago = Tipopago::where([['name', $row[25]], ['estado', 1]])->first();
        $TipoNegocio = TipoNegocio::where([['name', $row[26]], ['estado', 1]])->first();
        $FormaPedido = FormaPedido::where([['name', $row[27]], ['estado', 1]])->first();
        $Chofer = Chofer::where([['nombre', $row[28]], ['estado', 1]])->first();
        $ZonaDespacho = ZonaDespacho::where([['name', $row[29]], ['estado', 1]])->first();

        // Acumular errores si alguno de los datos no se encuentra
        if (!$Documento) $errors[] = "Documento no encontrado para: " . $row[1];
        if (!$Tipocliente) $errors[] = "Tipo de cliente no encontrado para: " . $row[3];
        if (!$GrupoCliente) $errors[] = "Grupo cliente no encontrado para: " . $row[4];
        if (!$Preventista) $errors[] = "Preventista no encontrado para: " . $row[23];
        if (!$AcuerdoCliente) $errors[] = "Acuerdo cliente no encontrado para: " . $row[24];
        if (!$Tipopago) $errors[] = "Tipo de pago no encontrado para: " . $row[25];
        if (!$TipoNegocio) $errors[] = "Tipo de negocio no encontrado para: " . $row[26];
        if (!$FormaPedido) $errors[] = "Forma de pedido no encontrado para: " . $row[27];
        if (!$Chofer) $errors[] = "Chofer no encontrado para: " . $row[28];
        if (!$ZonaDespacho) $errors[] = "Zona de despacho no encontrada para: " . $row[29];

        if (count($errors) > 0) {
            // Si hay errores en la fila, acumulamos los errores
            $allErrors[] = ['row' => $row, 'errors' => $errors];
            return null; // No procesamos esta fila
        }

        // Asignación y creación del cliente
        $tipos = [
            "" => "0",
            "POR MAYOR" => "5",
            "OFERTA" => "6",
            "LIQUIDACION" => "7",
            "C/FACTURA" => "8",
            "SUCURSAL" => "9",
        ];

        // Definir los tipos
        $tipoCajaCerrada = $tipos[$row[19]] ?? 0;
        $tipoPolloLimpio = $tipos[$row[20]] ?? 0;
        $tipoPT = $tipos[$row[21]] ?? 0;
        $tipoTrans = $tipos[$row[22]] ?? 0;

        // Crear el cliente
        $cliente = new Cliente();
        $cliente->nombre = $row[0];
        $cliente->documento_id = $Documento->id;
        $cliente->doc = $row[2];
        $cliente->tipocliente_id = $Tipocliente->id;
        $cliente->cinta_cliente_id = $GrupoCliente->id;
        $cliente->caja_cerrada = $row[5] == 'SI' ? 1 : 0;
        $cliente->telefono = $row[6];
        $cliente->direccion = $row[7];
        $cliente->correo = $row[8];
        $cliente->limite_crediticio = $row[9];
        $cliente->creditos_activos = $row[10];
        $cliente->dias_horas = $row[11];
        $cliente->latitud = $row[12];
        $cliente->longitud = $row[13];
        $cliente->horario_preferencia = $row[14];
        $cliente->horario_pedido = $row[15];
        $cliente->dinero_cuenta = $row[16];
        $cliente->deuda_heredada = $row[17];
        $cliente->interes = $row[18];
        $cliente->tipo_pollo_limpia = $tipoPolloLimpio;
        $cliente->tipo_caja_cerrada = $tipoCajaCerrada;
        $cliente->tipo_pt = $tipoPT;
        $cliente->tipo_trans = $tipoTrans;
        $cliente->preventista_id = $Preventista->id;
        $cliente->acuerdo_cliente_id = $AcuerdoCliente->id;
        $cliente->tipopago_id = $Tipopago->id;
        $cliente->tipo_negocio_id = $TipoNegocio->id;
        $cliente->forma_pedido_id = $FormaPedido->id;
        $cliente->chofer_id = $Chofer->id;
        $cliente->zona_despacho_id = $ZonaDespacho->id;
        $cliente->is_iva = $row[30] == 'SI' ? 1 : 0;
        $cliente->iva = $row[30] == 'SI' ? $row[31] : 0;
        $cliente->estado = $row[32] == 'SI' ? 1 : 0;
        $cliente->aprobado = $row[33] == 'SI' ? 1 : 0;
        $cliente->activo = $row[34] == 'SI' ? 1 : 0;

        // Guardar el cliente
        $cliente->save();

        // Confirmar la transacción
        DB::commit();

        return $cliente;
    } catch (\Exception $e) {
        // Revertir la transacción si hubo un error
        DB::rollBack();
        Log::error("Error al procesar la fila: " . $e->getMessage());
        $allErrors[] = ['row' => $row, 'errors' => ['Error al procesar esta fila.']];
        return null;
    }
}

// Al final de todo el proceso, devolver los errores acumulados
if (!empty($allErrors)) {
    return response()->json(['errors' => $allErrors], 400);
} else {
    return response()->json(['message' => 'Todos los clientes fueron importados correctamente.'], 200);
}



}
