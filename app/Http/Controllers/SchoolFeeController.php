<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use App\Models\Account;
use App\Models\school_fee;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;

class SchoolFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    //sessions
    $sessions= AcademicSession::all();

    //accounts
    $accounts=Account::all();

    //streams
    $streams=Stream::all();

    //feeStructure

    return view('accounting.fees-management.fee-structure.index', compact('streams', 'accounts', 'sessions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
        // $validation=$request->validate([
        //     'stream_id'=>'required',
        //     'session_id'=>'required'

        // ]);



$stream_id=$request->stream_id;
$session_id=$request->session_id;

dd($request->all());

        $accounts = DB::table('school_fees')
        ->rightJoin('accounts', 'accounts.id', '=', 'school_fees.account_id')
        ->leftJoin('streams', 'streams.id', '=', 'school_fees.stream_id')
        ->leftJoin('academic_sessions', 'academic_sessions.id', '=', 'school_fees.session_id')
        ->where('school_fees.session_id',$session_id)
        ->where('school_fees.stream_id',$stream_id)
        ->select('accounts.id as account_id', 'accounts.account_name', 'school_fees.amount as amount', 'school_fees.id as fee_structure_item_id', 'academic_sessions.id as session_id', 'streams.id as stream_id')
        ->get();


   return response()->json([
            'accounts'=>$accounts,
            'session'=>$session_id,
            'stream'=>$stream_id,
            

    ]);

       


     
        
      
    }

    public function getStream($stream_id){

        
        $stream=Stream::find($stream_id);

        return response()->json([
            'stream'=>$stream->stream_name,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

dd($request->all());
      
        // for($i = 0; $i <count($load); $i++) {

        //     $addTeachingLoads=StudentLoad::create([
        //     'student_id'=>$load[$i],
        //     'teaching_load_id'=>$teaching_load_id,
        //     'session_id'=>$request->academic_session,
        //     'active'=>1
        //     ]);
        
        //  }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\school_fee  $school_fee
     * @return \Illuminate\Http\Response
     */
    public function show(school_fee $school_fee, Request $request)
    {
        dd($request->all());
        return view('accounting.fees-management.fee-structure.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\school_fee  $school_fee
     * @return \Illuminate\Http\Response
     */
    public function edit(school_fee $school_fee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\school_fee  $school_fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, school_fee $school_fee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\school_fee  $school_fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(school_fee $school_fee)
    {
        //
    }


   
}
