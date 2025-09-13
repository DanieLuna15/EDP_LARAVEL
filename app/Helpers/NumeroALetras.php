<?php

namespace App\Helpers;

class NumeroALetras
{
    private static $UNIDADES = ['', 'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE',
        'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO', 'DIECINUEVE', 'VEINTE'];
    private static $DECENAS = ['', '', 'VEINTE', 'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA', 'OCHENTA', 'NOVENTA'];
    private static $CENTENAS = ['', 'CIENTO', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS',
        'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS'];

    /**
     * Convierte un número a texto en español.
     *
     * @param float $numero  El número a convertir.
     * @param string $moneda Nombre de la moneda (ej. 'BOLIVIANOS').
     * @return string         El texto en mayúsculas.
     */
    public static function convert(float $numero, string $moneda = ''): string
    {
        $entero = intval(floor($numero));
        $decimales = intval(round(($numero - $entero) * 100));

        if ($decimales == 100) {
            $entero += 1;
            $decimales = 0;
        }

        $textoEntero = self::convertirNumero($entero);
        $textoDec = sprintf('%02d/100', $decimales);

        $resultado = trim("$textoEntero $textoDec $moneda");
        return preg_replace('/\s+/', ' ', $resultado);
    }

    private static function convertirNumero(int $n): string
{
    if ($n < 21) {
        return self::$UNIDADES[$n];
    } elseif ($n < 30) {
        // Para los números entre 21 y 29, directamente utilizamos "VEINTIUNO", "VEINTIDOS", etc.
        return 'VEINTI' . self::$UNIDADES[$n - 20];
    } elseif ($n < 100) {
        $dec = intdiv($n, 10);
        $uni = $n % 10;
        $texto = self::$DECENAS[$dec];
        if ($uni > 0) {
            $texto .= ' Y ' . self::$UNIDADES[$uni];
        }
        return $texto;
    } elseif ($n < 1000) {
        if ($n == 100) return 'CIEN';
        $cen = intdiv($n, 100);
        $resto = $n % 100;
        return self::$CENTENAS[$cen] . ' ' . self::convertirNumero($resto);
    } elseif ($n < 1000000) {
        $miles = intdiv($n, 1000);
        $resto = $n % 1000;
        $texto = ($miles > 1 ? self::convertirNumero($miles) . ' MIL' : 'MIL');
        if ($resto > 0) {
            $texto .= ' ' . self::convertirNumero($resto);
        }
        return $texto;
    } elseif ($n < 1000000000000) {
        $millones = intdiv($n, 1000000);
        $resto = $n % 1000000;
        $texto = ($millones > 1 ? self::convertirNumero($millones) . ' MILLONES' : 'UN MILLON');
        if ($resto > 0) {
            $texto .= ' ' . self::convertirNumero($resto);
        }
        return $texto;
    }
    return '';
}

}
