<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Communication;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('academic-admin.communication-management.index');
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

        $audience=$request->recipient;
        $channel=$request->channel;
        $message=$request->message;

      //  $username = config('app.sms_username');// use 'sandbox' for development in the test environment
     //   $apiKey   = config('app.sms_password'); // use your sandbox app API key for development in the test environment
     //   $AT = new AfricasTalking($username, $apiKey);
       
        if($audience=="teachers"){
            $teacher_role=Role::where('name', 'teacher')->first();
    $teacher_role_id=$teacher_role->id;

    $teachers=User::where('role_id', $teacher_role_id)->where('active', '1')->get();
    $total_teachers=$teachers->count();

  

    // for($i = 0; $i <count($load); $i++) {

    //     $addTeachingLoads=StudentLoad::create([
    //     'student_id'=>$teachers[$i],
    //     'teaching_load_id'=>$teaching_load_id,
    //     'session_id'=>$request->academic_session,
    //     'active'=>1
    //     ]);
    
    //  }
  

    
    for ($i=0; $i <$total_teachers; $i++) { 

        $cell_number=$teachers[$i]->cell_number;
        $name=$teachers[$i]->name;
        $lastname=$teachers[$i]->lastname;
        $salutation=$teachers[$i]->salutation;
        $id=$teachers[$i]->id;


        $teacher=Communication::create([
            'channel'=>$channel,
            'sender'=>Auth::user()->id,
            'total'=>$total_teachers,
            'message'=>$message,
            'audience'=>$audience,
            'recipients'=> implode($cell_number, ',');
            ]);
      
    }
   
    


    

  

 

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function show(Communication $communication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function edit(Communication $communication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Communication $communication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Communication  $communication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Communication $communication)
    {
        //
    }
}
