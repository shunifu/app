<?php

namespace App\Exports;

use App\Models\Grade;
use App\Models\Grades;
use Maatwebsite\Excel\Concerns\FromCollection;

class GradesTestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Grade::all();
    }
}
