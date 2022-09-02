<?php

namespace App\Http\Controllers;

use App\Models\Assessement;
use App\Models\AssessementProgressReport;
use Illuminate\Http\Request;
use App\Models\AssessementType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AssessementTypeController extends Controller
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
                'assessement_type'=>'required'
            ]);

            AssessementType::create([
                'assessement_type_name'=>$request->assessement_type,
            ]);
    
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added Assessement Type', 'Add Assessement Type');
            return Redirect::back();
            
        }else{
            return view('errors.unauthorized');
        }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssessementType  $assessementType
     * @return \Illuminate\Http\Response
     */
    public function show(AssessementType $assessementType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssessementType  $assessementType
     * @return \Illuminate\Http\Response
     */
    public function edit(AssessementType $assessementType, $id)
    {

       

        
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){
            $assessement=AssessementType::find(decrypt($id));
            

            return view('academic-admin.settings-management.assessements.assessement-type.edit', compact('id', 'assessement'));
        }else{
            return view('errors.unauthorized');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssessementType  $assessementType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssessementType $assessementType)
    {

        $id=$request->id;
        $type_id=decrypt($id);

        //validate
        $validation=$request->validate([
            'assessement_type'=>'required'
        ]);

        $update= AssessementType::find($type_id)->update([
            'assessement_type_name'=>$request->assessement_type
        ]);

        if($update){
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have updated Assessement Type', 'Update Assessement Type');
           return Redirect::back();
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssessementType  $assessementType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssessementType $assessementType, $id)
    {
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){

            //check if assessment is not in use


         
            $existsInAssessements=Assessement::where('assessement_type', $id)->exists();
            $existsInAssessementProgressReport=AssessementProgressReport::where('assessement_type', $id)->exists();

            if($existsInAssessements OR $existsInAssessementProgressReport ){
                flash()->overlay('Error. Cannot delete assessement type, as it is already used in assessements settings', 'Delete Assessement Type');
                return redirect()->back(); 
            }else{
                $delete=AssessementType::find($id)->delete();
                 flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted Assessement Type', 'Delete Assessement Type');
            return redirect()->back(); 
            }

      
            
        }else{
            return view('errors.unauthorized');
        }
    }
}
