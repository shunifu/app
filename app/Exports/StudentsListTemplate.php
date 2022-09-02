<?php

namespace App\Exports;

use App\Exports\StudentsListTemplate;
use App\Models\Grade;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class StudentsListTemplate implements WithMultipleSheets
{

    // private $grade;

    // public function __construct (int $grade){
    //     $this->grade=$grade;

    // }
 
    public function sheets(): array{

        $sheets=[];

        $grades=Grade::all();

        foreach ($grades as $key => $value) {
            $grade=$value->grade_name;
            $sheets[]=new StudentsExport($grade);
           
        }
        return $sheets;



    }

}
