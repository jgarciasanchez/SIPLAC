<?php

namespace App\Exports;

use App\cursoProfesor;
use App\Profesores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProfesoresExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use RegistersEventListeners;
    public function headings(): array{

        return [

            'Nombre Completo',

            '',

            '',

            '',

            'Nombre del Curso',

            'Código',

            'NRC',

            'Creditos'

        ];

    }
    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getDelegate()->mergeCells('A1:D1','A2:D2');
    }

    public function collection()
    {
        return cursoProfesor::ProfesorxCurso()->paginate(99999);
    }
}
