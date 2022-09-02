<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

 /**
     * @param Request $request
     * @return $this|false|string
     */

trait MarksTrait{

   
        // public $hour;


    public function teaching_loads(){

        $teaching_loads = DB::table('teaching_loads')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('academic_sessions', 'teaching_loads.session_id', '=', 'academic_sessions.id')
        ->where('teaching_loads.teacher_id', Auth::user()->id)
        ->where('academic_sessions.active', 1 )
        ->where('teaching_loads.active', 1 )
        ->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
        ->get();
        return $teaching_loads;

        }

        public function assessements(){

            //Assessment Lists
$assessements=DB::table('assessements')
->join('terms','terms.id','=','assessements.term_id')
->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
->where('academic_sessions.active', 1 )
->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
->get();

return $assessements;


        }

        // public function assessement_description(){
        //     $assessement_description=DB::table('assessements')
        //     ->join('terms','terms.id','=','assessements.term_id')
        //     ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        //     ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        //     ->where('academic_sessions.active', 1 )
        //     ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        //     ->get();
        // }

    }



?>


 