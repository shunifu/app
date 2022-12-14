<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\Stream;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\AssessementType;
use App\Models\AssessementSetting;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AssessementSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Assessement Type
        $assessement_types=AssessementType::all();


        if (!Schema::hasColumn('assessement_weights', 'stream_id')) //check the column
    {
        Schema::table('assessement_weights', function (Blueprint $table)
        {
           
            $table->string('stream_id');
        });
    }


        //Assessement Term
        $assessement_=DB::table('terms')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
        ->get();

        

        //Assessment Lists
        $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as term_id','assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name', 'academic_sessions.academic_session', 'assessement_month', 'marks_deadline', 'marks_extension')
        ->get();

    $assessements_collection=$assessements->collect();
    $assessements_=$assessements_collection->groupBy('term_id')->toArray();

      

        //Assign CA/Exam
        $ca_exam_assignments=DB::table('c_a__exams')
        ->join('terms','terms.id','=','c_a__exams.term_id')
        ->join('assessements','assessements.id','=','c_a__exams.assessement_id')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1)
     //   ->where('academic_sessions.active', 1) you can add this as well
        ->select('assessements.id as assessement_id','c_a__exams.id as assignment_id','terms.id as term_id', 'terms.term_name', 'assessement_name', 'assign_as')
        ->get();

        $ca_exam_assignments_collection=$ca_exam_assignments->collect();
        $ca_exam_assignments_=$ca_exam_assignments_collection->groupBy('term_id')->toArray();


   //   dd($ca_exam_assignments_);

//dd($ca_exam_assignments);

       //Assessement Weight
       $assessement_weight=DB::table('assessement_weights')
       ->join('terms','terms.id','=','assessement_weights.term_id')
       ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
       ->join('streams','streams.id','=','assessement_weights.stream_id')
       ->where('academic_sessions.active', 1)
       ->select('terms.id as term_id','streams.stream_name','streams.id as stream_id','assessement_weights.id as assessement_weight_id','ca_percentage','exam_percentage','terms.term_name')
       ->get();

       //Section
       $sections=Section::all();
       $streams=Stream::all();

       $assessement_weight_collection=$assessement_weight->collect();
       $assessement_weight_=$assessement_weight_collection->groupBy('term_id')->toArray();

    //    dd($assessement_weight_);

       //Pass Rates
       $pass_rates=DB::table('pass_rates')
       ->join('sections','sections.id','=','pass_rates.section_id')
       ->select('pass_rates.id as pass_rate_id','sections.section_name','average_calculation','subject_average_calculation', 'passing_rate','number_of_subjects','passing_subject_rule', 'position_type')
       ->get();
       
       $assessement_terms=DB::table('terms')
       ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
       ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
       ->get();

    return view('academic-admin.settings-management.assessements.index', compact('streams','assessements_','assessement_types', 'assessement_terms', 'assessements', 'ca_exam_assignments',  'sections', 'pass_rates', 'ca_exam_assignments_', 'assessement_weight_'));
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssessementSetting  $assessementSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AssessementSetting $assessementSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssessementSetting  $assessementSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AssessementSetting $assessementSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssessementSetting  $assessementSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssessementSetting $assessementSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssessementSetting  $assessementSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssessementSetting $assessementSetting)
    {
        //
    }
}
