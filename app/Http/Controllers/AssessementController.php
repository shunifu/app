<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Assessement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssessementProgressReport;
use Illuminate\Support\Facades\Validator;

class AssessementController extends Controller
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
                'assessement_type'=>'required',
                'assessement_term'=>'required',
                'assessement_name'=>'required',
                'assessement_month'=>'required',
                // 'marks_deadline'=>'required'
            ]);

            Assessement::create([
                'assessement_name'=>$request->assessement_name,
                'term_id'=>$request->assessement_term,
                'assessement_type'=>$request->assessement_type,
                'assessement_month'=>$request->assessement_month,
                'marks_deadline'=>$request->marks_deadline,
            ]);
    
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added Assessement', 'Add Assessement');
            return redirect()->back();
            

        }else{
            return view('errors.unauthorized');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assessement  $assessement
     * @return \Illuminate\Http\Response
     */
    public function show(Assessement $assessement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assessement  $assessement
     * @return \Illuminate\Http\Response
     */
    public function edit(Assessement $assessement, $id)
    {

        $assessement=Assessement::find($id);

        if($assessement){

            return response()->json([
                'status'=>200,
                'assessement'=>$assessement,
            ]);

        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Assessement not found",
            ]);

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assessement  $assessement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assessement $assessement)
    {


        // dd($request->all());

        
     //   dd($request->all());
        $validator=Validator::make($request->all(),[

            // 'edit_assessement_name'=>'required', 
            // 'edit_assessement_month'=>'required',
            // 'edit_assessement_type'=>'required',
            // 'term_id'=>'required',
            // 'edit_marks_deadline'=>'required',
        ]);

      

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),

            ]);

        }else{
            $assessement=Assessement::find($request->assessement_id);


         //   dd($assessement);
    
            
            if ($assessement) {

                Assessement::find($request->assessement_id)->update([
                'assessement_name'=>$request->edit_assessement_name, 
                'assessement_month'=>$request->edit_assessement_month,
                'assessement_type'=>$request->edit_assessement_type,
                'term_id'=>$request->term_id,
                'marks_deadline'=>$request->edit_marks_deadline,
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=>"Assessement updated successfully"

                ]);
    
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>"Assessement not found",

                ]);
            }


        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assessement  $assessement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assessement $assessement, $id)
    {
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        if ($isAdmin){

           //check if the assesement is already attached in marks table & scoresheet table

           $existsInMarks=Mark::where('assessement_id',$id)->exists();
           $existsInProgressReport=AssessementProgressReport::where('assessement_id',$id)->exists();
           if ($existsInMarks OR $existsInProgressReport ) {
            // flash()->overlay('<i class="fas fa-exclamation-circle text-danger mr-1"></i>Sorry. You cannot delete that assessement as it has already been assigned in student marks', 'Delete Assessement');
            // return redirect()->back(); 
            return response()->json([
                'status'=>400,
                'errors'=>"Sorry. You cannot delete that assessement as it has already been assigned in student marks",

            ]);
           }else{
            Assessement::find($id)->delete();
            // flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted Assessement', 'Delete Assessement');
            //     return redirect()->back();

            return response()->json([
                'status'=>200,
                'message'=>"You have successfully deleted Assessement"

            ]);

           }


    
            
        }else{
            return view('errors.unauthorized'); 
        }

    }
}
