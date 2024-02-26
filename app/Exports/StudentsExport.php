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

                        // 'name'=>$row['name'],
                        // 'lastname'=>$row['lastname'],
                        // 'middlename'=>$row['middlename'],
                        // 'national_id'=>$row['pin'],
                        // 'date_of_birth' => $row['date_of_birth'],
                        // 'user_code'=>$row['admission_number'],
                        // 'cell_number'=>$row['student_cell'],
                        // 'gender'=>$row['gender'],
                        // 'role_id'=>$student_role->id,
                        // 'password'=>Hash::make(Str::random(5)),

    public function map($user):array
    {
        return[
            $user->admission_number,
            $user->lastname,
            $user->name,
            $user->middlename,
            $user->gender,
            $user->pin,
            $user->class,
            $user->date_of_birth,
            $user->student_cell,
            $user->parent_cell,
            $user->parent_email,


        ];

    }

    public function headings():array
    {
        return [
           'admission_number',
            'lastname',
            'name',
            'middlename',
            'gender',
            'pin',
            'class',
            'date_of_birth',
            'student_cell',
            'parent_cell',
            'parent_email',

        ];

    }

    public function  registerEvents():array
    {
        return [
            AfterSheet::class=>function(AfterSheet $event){
                $event->sheet->getStyle('A2:A3:A7')->applyFromArray([
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
