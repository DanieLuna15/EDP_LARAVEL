<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
class ClienteExport implements FromView,WithStyles
{
    public $Cliente;
    public function __construct()
    {

    }
    public function styles(Worksheet $sheet)
    {
        return [

        ];
    }
    public function view():View
    {
        return view('excel.client.template');
    }

}
