<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\ReportTemplate;
use App\Models\ReportVariable;
use App\Models\Section;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CBEReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             //Terms

             $terms=DB::table('terms')
             ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
             ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
             ->where('academic_sessions.active',1)
             ->get();
     
     
             //Scope to current session ....think about it.
     
             //Streams
             $streams=Stream::all();
     
             //Classes
             $classes=Grade::all();
     
             //Section
             $sections=Section::all();
     
            
     
             $templates=ReportTemplate::all();
     
             $variables=ReportVariable::all();
     
             if (is_null($templates) ) {
     
                 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add report templates. To do so, please go to settings , then Report Settings and click Report Templates');
                 return redirect('/report/templates');
     
               
             }
     
             if (is_null($variables) ) {
     
                 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add report variables. To do so, please go to settings , then Report Settings and click Report Variables');
                 return redirect('/report/variables');
     
               
             }
             
             return view('academic-admin.reports-management.cbe-report.index', compact('terms','streams','classes','sections','templates','variables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        dd($request->all());


        $students=DB::table('grades')
        ->join('grades_students', 'grades_students.grade_id', '=', 'grades.id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
        ->where('academic_sessions.active',1)
        ->where('grades_students.active',1)
        ->where('grades')
        ->get();


         

        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
