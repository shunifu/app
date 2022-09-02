<?php

namespace App\Http\Controllers;

use App\Models\CA_Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CAExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){

           
            $validation=$request->validate([
                'assessement_term'=>'required',
                'assessement_name'=>'required', 
                'assign_as'=>'required'
            ]);

       

            CA_Exam::create([
                'assessement_id'=>$request->assessement_name,
                'term_id'=>$request->assessement_term,
                'assign_as'=>$request->assign_as
            ]);
    
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have assigned assessements', 'Assign Assessements');
            return redirect()->back();
            
        }else{
            return view('errors.unauthorized');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CA_Exam  $cA_Exam
     * @return \Illuminate\Http\Response
     */
    public function show(CA_Exam $cA_Exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CA_Exam  $cA_Exam
     * @return \Illuminate\Http\Response
     */
    public function edit(CA_Exam $cA_Exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CA_Exam  $cA_Exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CA_Exam $cA_Exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CA_Exam  $cA_Exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(CA_Exam $cA_Exam, $id)
    {
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){
           $delete= CA_Exam::find($id)->delete();

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted Assignment', 'Delete Assignment');
            return redirect()->back();
            
        }else{
            return view('errors.unauthorized');
        }
    }
}
