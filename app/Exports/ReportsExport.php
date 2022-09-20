<?php

namespace App\Exports;

use App\Models\Attendance;

use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ReportsExport implements FromCollection , WithColumnWidths , WithEvents
{

    protected $registros;
    protected $filas;

    public function __construct(array $registros , int $filas)
    {
        $this->registros = $registros;
        $this->filas = $filas;
    }

    public function collection()
    {
        return new Collection( $this->registros );
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            "C" => 15,
            "D" => 40,
            "E" => 20,
            "F" => 35,
            "G" => 16,
            "H" => 12        
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->getDelegate()->getStyle("A1:H".($this->filas+1)."")
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

}