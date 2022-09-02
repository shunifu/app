<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessementWeight;
use Illuminate\Support\Facades\Auth;

class AssessementWeightController extends Controller
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
                'ca_percentage'=>'required|numeric|max:100', 
                'exam_percentage'=>'required|numeric|max:100'
            ]);

            $termExists=AssessementWeight::where('term_id',$request->assessement_term)->exists();

            if($termExists){
                flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Term already exists. You can either edit or delete the term before assigning new assessement weight to it', 'Add Assessement Weights');
                return redirect()->back();
            }

            if((($request->ca_percentage)+($request->exam_percentage))==100){

               

            AssessementWeight::create([
                'term_id'=>$request->assessement_term,
                'ca_percentage'=>$request->ca_percentage,
                'exam_percentage'=>$request->exam_percentage
            ]);
    
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have assigned assessements', 'Assign Assessements');
            return redirect()->back();

            }else{
                flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Please check your values. Both CA and Exam should equal to 100%', 'Add Assessement Weights');
                return redirect()->back();
     
            }
            
        }else{
            return view('errors.unauthorized');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssessementWeight  $assessementWeight
     * @return \Illuminate\Http\Response
     */
    public function show(AssessementWeight $assessementWeight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssessementWeight  $assessementWeight
     * @return \Illuminate\Http\Response
     */
    public function edit(AssessementWeight $assessementWeight, $id)
    {

        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){
       
          $assessement_weight= AssessementWeight::where('id', $id)->get();
         
return view('academic-admin.settings-management.assessements.assessement-weight.edit', compact('assessement_weight'));

      

        }
    
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssessementWeight  $assessementWeight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssessementWeight $assessementWeight)
    {

 //       dd($request->all());
       
        if(($request->ca_weight)+($request->exam_weight)==100){
            AssessementWeight::where('id',$request->id)->update([
                'ca_percentage'=>$request->ca_weight,
                'exam_percentage'=>$request->exam_weight,
            ]);
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have updated Assessement Weight', 'Update Assessement Weight');
            return redirect('settings/assessement#pills-weight');
        }else{
            flash()->overlay('Error. Must equal to 100%', 'Update Assessement Weight');
            return redirect('settings/assessement#pills-weight');
        }
        //Update
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssessementWeight  $assessementWeight
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssessementWeight $assessementWeight, $id)
    {
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){
           $delete= AssessementWeight::find($id)->delete();

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted Assessement Weight', 'Delete Assessement Weight');
            return redirect()->back();
            
        }else{
            return view('errors.unauthorized');
        }
    }
}
