<?php

namespace App\Exports;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class StudentsExport implements  
ShouldAutoSize, 
WithMapping, 
WithHeadings,
WithEvents,
WithTitle
// FromQuery

{
    use Exportable;

    private $grade;

    public function __construct(string $grade)
    {
        $this->grade=$grade;
         
    }

    
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function query()
    // {
    //     return User::query();
    // }

    public function map($user):array
    {
        return[
            $user->id, 
            $user->Student,
            $user->Middlename, 
            $user->Lastname, 
            $user->ParentCell, 
            $user->ParentEmail, 

        ];

    }

    public function headings():array
    {
        return [
            '#', 
            'Student Name',
            'Student Middlename',
            'Student Surname', 
            'Parent Cell',
            'Parent Email',
          
        ]; 

    }

    public function  registerEvents():array
    {
        return [
            AfterSheet::class=>function(AfterSheet $event){
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font'=>[

                        'bold'=>true
                    ]
                    ]);
            }
            
        ];

    }

    public function title(): string {

       return $this->grade;

    }


    // public function title(): string
    // {
    //     return 'Month';
    // }
}
