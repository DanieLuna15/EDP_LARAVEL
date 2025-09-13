<?php

namespace App\Exports;

use App\Models\Compra;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
class CompraExport implements FromView,WithStyles
{
    public $compra;
    public function __construct($compra)
    {
        $this->compra = $compra;
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // // Style the first row as bold text.
            // 1    => ['font' => ['bold' => true]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
    public function view():View
    {
        return view('reportes.pdf.almacen.compra_excel', ["compra"=>$this->compra]);
    }
    
}
