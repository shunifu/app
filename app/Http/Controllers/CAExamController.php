<?php

namespace App\Http\Controllers;

use App\Models\CA_Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function edit(CA_Exam $cA_Exam, $id)
    {


    $categorization_id= CA_Exam::find(decrypt($id));

    $categorizations=DB::table('c_a__exams')
    ->join('terms','terms.id','=','c_a__exams.term_id')
    ->join('assessements','assessements.id','=','c_a__exams.assessement_id')
    ->where('c_a__exams.id', $categorization_id->id )
    ->select('c_a__exams.id as catergorization_id','terms.term_name', 'assessements.assessement_name', 'assign_as')
    ->first();

    //dd($categorization_id->id);

    return view('academic-admin.settings-management.assessements.assessement-categorization.edit', compact('categorization_id','categorizations'));






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
   

        //validation

        $validation=$request->validate([
            'assign_as'=>'required'
        ]);

        $id=$request->id;
        $assign_as=$request->assign_as;

        $update=CA_Exam::find($id)->update([
            'assign_as'=>$assign_as,
        ]);

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have updated categorization', 'Assign Categorization');
        return redirect()->back();


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

          
            
           $delete= CA_Exam::find(decrypt($id))->delete();

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted Assignment', 'Delete Assignment');
            return redirect()->back();
            
        }else{
            return view('errors.unauthorized');
        }
    }
}
