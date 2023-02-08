<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Allocation;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use CreateDaysTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

class AllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades=Grade::all();
        $subjects=Subject::all();
        $sessions=AcademicSession::all();


        if (!Schema::hasTable('allocations')) {
            Schema::create('allocations', function($table){
                  
                   $table->id();
                   $table->integer('subject_id');
                   $table->integer('grade_id');
                   $table->integer('academic_year')->nullable();
                   $table->integer('active')->default('1');
                   $table->timestamps();
           });
       }

       $getActiveSession=AcademicSession::where('active', 1)->first();
       $ActiveSession=$getActiveSession->id;

        $allocations = DB::table('allocations')
        ->join('subjects', 'subjects.id', '=', 'allocations.subject_id')
        ->join('grades', 'grades.id', '=', 'allocations.grade_id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'allocations.academic_year')
        ->select('grades.id as grade_id', 'allocations.id as allocation_id', 'subjects.id as subject_id', 'subjects.subject_name', 'grades.grade_name', 'academic_sessions.academic_session')
        ->where('academic_year', $ActiveSession)
        ->groupBy('grades.id')
        ->get();

      

        return view('academic-admin.allocations-management.index',compact('subjects', 'grades', 'allocations', 'sessions', 'ActiveSession') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$request->validate([
            'grade'=>'required',
            'session'=>'required',
        ]);


        $grade=$request->grade;
        $session=$request->session;
        $subjects=$request->subjects;
        $count=count($subjects);

        //check if allocation exists\

        //if allocation exists, then do not add\\

    $allocationExists=Allocation::where('grade_id', $grade)->where('academic_year', $session)->exists();

        if ($allocationExists) {

            flash()->overlay('<i class="fas fa-check-circle text-warning"></i>'.' Warning, Allocations already exists . ', 'Response');
            return Redirect::back();
        }else{

            foreach ($subjects as $key => $value) {

                Allocation::create([
    
                    'grade_id'=>$grade,
                    'academic_year'=>$session,
                    'subject_id'=>$value,
                    'active'=>'1',
    
                ]);
               
            }

            flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Success, Allocations added . ', 'Response');
            return Redirect::back();

        }
     
       

   

      

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function show(Allocation $allocation, $grade_id, $academic_session)
    {
        $class_id=decrypt($grade_id);

      
     
      //  $allocation=Allocation::where('id',$allocation_id)->get();


 $allocation = DB::table('allocations')
        ->join('subjects', 'subjects.id', '=', 'allocations.subject_id')
        ->join('grades', 'grades.id', '=', 'allocations.grade_id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'allocations.academic_year')
        ->select('allocations.id as allocation_id','grades.id as grade_id', 'allocations.id as allocation_id', 'subjects.id as subject_id', 'subjects.subject_name', 'grades.grade_name', 'academic_sessions.academic_session')
        ->where('allocations.grade_id', $class_id)
        ->where('allocations.academic_year', $academic_session)
        ->get();
       
        return view('academic-admin.allocations-management.view',compact('allocation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Allocation $allocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allocation $allocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allocation $allocation)
    {
        //
    }
}
