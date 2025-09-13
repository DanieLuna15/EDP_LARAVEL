<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlanillasExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        // Solo fila vacía porque solo necesitas la cabecera
        return [];
    }

    public function headings(): array
    {
        return [
            'Documento',
            'Desde',
            'Hasta',
            'Faltas (N)',
            'Atrasos (N)',
            'Extras (N)',
            'Venta Caja (N)',
            'Adeuda',
            'Plan',
            'Motivo Adeudo',
            'Observación',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1F4E78'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color'       => ['rgb' => '000000'],
                ],
            ],
        ];

        $lastColumn = chr(64 + count($this->headings())); 
        $range = "A1:{$lastColumn}1";

        return [
            $range => $styleArray
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 15,
            'C' => 15,
            'D' => 12,
            'E' => 12,
            'F' => 12,
            'G' => 16,
            'H' => 12,
            'I' => 10,
            'J' => 25,
            'k' => 30,
        ];
    }
}
