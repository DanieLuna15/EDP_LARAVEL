<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use mysqli;

class BackupController extends Controller
{
    public function index()
    {
        $path="./storage/backups/";
        $dir = opendir($path);
        // Leo todos los ficheros de la carpeta
        $list=[];
        while ($elemento = readdir($dir)){
            // Tratamos los elementos . y .. que tienen todas las carpetas
            if( $elemento != "." && $elemento != ".."){
                // Si es una carpeta
                if( is_dir($path.$elemento) ){
                    // Muestro la carpeta

                // Si es un fichero
                } else {
                    // Muestro el fichero
                    $list[]= $elemento;
                }
            }
        }
        return $list;
    }
    public function backup()
    {
        // Connect to database
        $mysqli = new mysqli(env('DB_HOST'), env('DB_USERNAME'),  env('DB_PASSWORD'), env('DB_DATABASE'));

        // Get all tables
        $tables = array();
        $result = $mysqli->query("SHOW TABLES");
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }

        // Cycle through each table
        $return = "";
        foreach ($tables as $table) {
            $result = $mysqli->query("SELECT * FROM $table");
            $num_fields = $result->field_count;

            // First part of the output - remove the table
            $return .= "DROP TABLE $table;";

            // Second part of the output - create table
            $row2 = $mysqli->query("SHOW CREATE TABLE $table")->fetch_row();
            $return .= "\n\n" . $row2[1] . ";\n\n";

            // Third part of the output - insert values into table
            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = $result->fetch_row()) {
                    $return .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = $row[$j];
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }
            $return .= "\n\n\n";
        }
        $name = Carbon::now()->format('d.m.Y') . '_' . Carbon::now()->format('h.i.s') . "_DB_Backup.sql";
        // Save the SQL script to a file

        $backupPath = storage_path('app/public/backups');
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0775, true);
        }
        $filePath = 'backups/' . $name;
        Storage::disk('public')->put($filePath, $return);

        $handle = fopen("./storage/backups/$name", "w+");
        fwrite($handle, $return);
        fclose($handle);

        // Close database connection
        $mysqli->close();
    }


    public function truncateTables(Request $request)
    {
        $tablesToTruncate = $request->input('tables');
        if (is_string($tablesToTruncate)) {
            $tablesToTruncate = explode(',', $tablesToTruncate);
        }
        if (empty($tablesToTruncate)) {
            return response()->json(['message' => 'No tables selected to truncate.'], 400);
        }
        $mysqli = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        if ($mysqli->connect_error) {
            return response()->json(['message' => 'Connection failed: ' . $mysqli->connect_error], 500);
        }

        foreach ($tablesToTruncate as $table) {
            $truncateQuery = "TRUNCATE TABLE $table";
            if ($mysqli->query($truncateQuery)) {
            } else {
            }
        }
        $mysqli->close();
        return response()->json(['message' => 'Las tablas seleccionadas han sido vaciadas.']);
    }


    public function truncateDefaultTables()
    {
        $excludeTables = [
            'usuario_sucursals', 'consolidacionparams', 'trans_item_detalles', 'trans_items','acuerdo_clientes', 'adeudacuotas', 'almacens', 'areas', 'bancos', 'banderas', 'cajacerrada_clientes', 'cajas', 'caja_motivos', 'caja_sucursals', 'caja_sucursal_usuarios', 'categorias', 'chofers', 'cinta_clientes', 'clientes', 'cogplanillas', 'contratos', 'costofijos', 'costovariables', 'documentos', 'estado_compra_chofers', 'filemonedas', 'filepersonas', 'files','filesucursals','formapagos', 'forma_pedidos', 'items', 'medidas', 'medida_productos', 'migrations', 'monedas', 'motivomemorandums', 'parametrovacacions', 'pollo_sucursals', 'productos', 'producto_precios', 'producto_precio_sucursals', 'promedio_mermas', 'proveedor_categorias', 'proveedor_categoria_detalles', 'proveedor_compras', 'sub_medidas','sucursals', 'tipoarchivos', 'tipoclientes', 'tipocontratos', 'tipopagos', 'tipo_cliente_pps', 'tipo_cliente_pp_limpios', 'tipo_negocios', 'turno_chofers', 'users', 'zona_despachos', 'model_has_permissions', 'model_has_roles', 'role_has_permissions', 'roles', 'permissions','personal_access_tokens','rol_users','menus', 'menu_roles', 'model_has_roles', 
        ];

        $mysqli = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));

        if ($mysqli->connect_error) {
            return response()->json(['message' => 'Connection failed: ' . $mysqli->connect_error], 500);
        }

        $mysqli->query("SET foreign_key_checks = 0;");
        $result = $mysqli->query("SHOW TABLES");
        $allTables = [];
        while ($row = $result->fetch_array()) {
            $allTables[] = $row[0];
        }
        $tablesToTruncate = array_diff($allTables, $excludeTables);
        foreach ($tablesToTruncate as $table) {
            $truncateQuery = "TRUNCATE TABLE $table";
            if (!$mysqli->query($truncateQuery)) {
            } else {
            }
        }
        $mysqli->query("SET foreign_key_checks = 1;");

        $mysqli->close();

        return response()->json(['message' => 'Las tablas han sido vaciadas (menos las excepciones).']);
    }

    public function truncatePrecios()
    {
        $includeTables = [
            'cliente_pps', 'cliente_pts','cliente_cajacerradas'
        ];
        $mysqli = new \mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        if ($mysqli->connect_error) {
            return response()->json(['message' => 'Connection failed: ' . $mysqli->connect_error], 500);
        }
        $mysqli->query("SET foreign_key_checks = 0;");
        foreach ($includeTables as $table) {
            $truncateQuery = "TRUNCATE TABLE $table";
            if (!$mysqli->query($truncateQuery)) {
            }
        }
        $mysqli->query("SET foreign_key_checks = 1;");
        $mysqli->close();
        return response()->json(['message' => 'Las tablas de precios se vaciaron exitosamente.']);
    }


    public function getTables()
    {
        $mysqli = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        if ($mysqli->connect_error) {
            return response()->json(['message' => 'Connection failed: ' . $mysqli->connect_error], 500);
        }
        $result = $mysqli->query("SHOW TABLES");
        $tables = [];
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
        $mysqli->close();
        return response()->json($tables);
    }
    public function restore(Request $request)
    {
        $name = $request->backup_id;
        $file = file_get_contents("./storage/backups/$name");
         // Connect to database
         $mysqli = new mysqli(env('DB_HOST'), env('DB_USERNAME'),  env('DB_PASSWORD'),env('DB_DATABASE'));

       // Get all tables
       $tables = array();

      $mysqli->multi_query($file);
       do {
        /* store the result set in PHP */
        if ($result = $mysqli->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);
            }
        }
        /* print divider */
        if ($mysqli->more_results()) {
            printf("-----------------\n");
        }
    } while ($mysqli->next_result());
    return $request->all();
    }
    public function download($id)
    {
        $name = $id;
        $file = "backups/$name";
        $url = Storage::disk('public')->download($file);
        return $url;
    }
}
