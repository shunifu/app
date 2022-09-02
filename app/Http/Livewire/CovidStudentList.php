<?php

namespace App\Http\Livewire;

use App\Models\Grade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CovidStudentList extends Component
{
    public $selectedClass=null;
    public $selectedStudent=null;
    public $students=null;
    public function render()
    {
        return view('livewire.covid-student-list', [
            'classes'=>Grade::all(),
        ]);

    }


    public function updatedSelectedClass($class_id){
        $this->students= DB::table('grades_students')
        ->join('users','grades_students.student_id','=','users.id')
        ->where('grades_students.grade_id', $class_id )
        ->select('users.name','users.lastname','users.id', 'users.middlename')
        ->orderBy('lastname', 'ASC')
        ->get();
    }

    
}
