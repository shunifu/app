<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Allocation;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use CreateDaysTable;
use Illuminate\Support\Facades\DB;

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

        $allocations = DB::table('allocations')
        ->join('subjects', 'subjects.id', '=', 'allocations.subject_id')
        ->join('grades', 'grades.id', '=', 'allocations.grade_id')
        ->select('grades.id as grade_id', 'allocations.id as allocation_id', 'subjects.id as subject_id', 'subjects.subject_name', 'grades.grade_name')
        ->where('active', 1)
        ->groupBy('grades.id')
        ->get();

      

        return view('academic-admin.allocations-management.index',compact('subjects', 'grades', 'allocations', 'sessions') );
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
     
        foreach ($subjects as $key => $value) {

            Allocation::create([

                'grade_id'=>$grade,
                'academic_year'=>$session,
                'subject_id'=>$value,
                'active'=>'1',

            ]);
           
        }

   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allocation  $allocation
     * @return \Illuminate\Http\Response
     */
    public function show(Allocation $allocation)
    {
        //
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
