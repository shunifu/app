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

if ($channel=="sms") {
    // $username = config('app.sms_username');
    // $apiKey   = config('app.sms_password');
    // $AT = new AfricasTalking($username, $apiKey);
    // $sms      = $AT->sms();




    if ($audience=="teachers") {
        $teacher_role=Role::where('name', 'teacher')->first();
        $teacher_role_id=$teacher_role->id;

        $teachers=User::where('role_id', $teacher_role_id)->where('active', '1')->whereNotNull('cell_number')->get();
        $total_teachers=$teachers->count();



        for ($i=0; $i <$total_teachers; $i++) {
            $cell_number=$teachers[$i]->cell_number;
            $name=$teachers[$i]->name;
            $lastname=$teachers[$i]->lastname;
            $salutation=$teachers[$i]->salutation;
            $id=$teachers[$i]->id;


            // Use the service
//             $result   = $sms->send([
//             'to'      => '+268'.$cell_number,
//             'message' => 'Hi '.$name.' '.$message,
//             'from'=>'Shunifu'
// ]);
        }
    }

    if ($audience=="parents") {
        $parent_role=Role::where('name', 'parent')->first();
        $parent_role_id=$parent_role->id;

        $parents=User::where('role_id', $parent_role_id)->where('active', '1')->whereNotNull('cell_number')->get();
        $total_parents=$parents->count();



        for ($i=0; $i <$total_parents; $i++) {
            $cell_number=$parents[$i]->cell_number;
            $name=$parents[$i]->name;
            $lastname=$parents[$i]->lastname;
            $salutation=$parents[$i]->salutation;
            $id=$parents[$i]->id;


//             // Use the service
//             $result   = $sms->send([
//             'to'      => '+268'.$cell_number,
//             'message' => 'Hi'.' '.$message,
//             'from'=>'Shunifu'
// ]);
        }
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
