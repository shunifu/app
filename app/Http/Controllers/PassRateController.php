<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\PassRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PassRateController extends Controller
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
                'section'=>'required',
                'number_of_subjects'=>'required|numeric|max:10', 
                'passing_rate'=>'required|numeric|max:100',
                'passing_subject_rule'=>'required',
                'average_calculation'=>'required',
                'position_type'=>'required',
                'subject_average_calculation'=>'required',
                'subject_position_type'=>'required',
            ]);

            $sectionExists=PassRate::where('section_id',$request->section)->exists();

            if($sectionExists){
                flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Section already exists. You can either edit or delete the section before assigning new rates to it', 'Add Passing Rate');
                return redirect()->back();
            }

            if($request->passing_rate<101){

            PassRate::create([
                'section_id'=>$request->section,
                'passing_rate'=>$request->passing_rate,
                'number_of_subjects'=>$request->number_of_subjects,
                'passing_subject_rule'=>$request->passing_subject_rule,
                'average_calculation'=>$request->average_calculation,
                'subject_average_calculation'=>$request->subject_average_calculation,
                'position_type'=>$request->position_type,
                'term_average_type'=>$request->term_average_type,
                'tie_type'=>$request->tie_type,
                'number_of_decimal_places'=>$request->number_of_decimal_places,
                'subject_position_type'=>$request->subject_position_type,
            ]);
    
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added pass rates', 'Add Pass Rates');
            return redirect()->back();

            }else{
                flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Please check your values. Pass rate cannot exceed 100%', 'Add Pass Rate');
                return redirect()->back();
     
            }
            
        }else{
            return view('errors.unauthorized');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PassRate  $passRate
     * @return \Illuminate\Http\Response
     */
    public function show(PassRate $passRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PassRate  $passRate
     * @return \Illuminate\Http\Response
     */
    public function edit(PassRate $passRate, $id)
    {

        $passrates=DB::table('pass_rates')
        ->join('sections','sections.id','=','pass_rates.section_id')
        ->where('pass_rates.id', '=',$id)
        ->select('pass_rates.*', 'sections.section_name')
        ->first();

     //   dd($passrates);

        $sections=Section::all();

      return view('academic-admin.settings-management.assessements.edit-pass-rates', compact('passrates', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PassRate  $passRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PassRate $passRate)
    {

        //validations

        $validation=$request->validate([
           
            'number_of_subjects'=>'required|numeric|max:10', 
            'passing_rate'=>'required|numeric|max:100',
            'passing_subject_rule'=>'required',
            'average_calculation'=>'required',
            'tie_type'=>'required',
            'term_average_type'=>'required',
        ]);

     
        if($request->has('number_of_decimal_places')){
            $number_of_decimal_places=$request->number_of_decimal_places;
          }else{
            $number_of_decimal_places=0;
          }
            Passrate::where('id', $request->pass_rate_id)->update([
                'passing_rate'=>$request->passing_rate,
                'number_of_subjects'=>$request->number_of_subjects,
                'passing_subject_rule'=>$request->passing_subject_rule,
                'average_calculation'=>$request->average_calculation,
                'tie_type'=>$request->tie_type,
                'term_average_type'=>$request->term_average_type,
                'number_of_decimal_places'=>$number_of_decimal_places,
                'subject_position_type'=>$request->subject_position_type,
            ]);

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have changed pass rates', 'Edit Pass Rate');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PassRate  $passRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(PassRate $passRate, $id)
    {
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){
           PassRate::find($id)->delete();

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted Pass Rate', 'Delete Pass Rate');
            return Redirect::back();
            
        }else{
            return view('errors.unauthorized');
        }
    }
}
