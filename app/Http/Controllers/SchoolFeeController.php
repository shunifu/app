<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use App\Models\Account;
use App\Models\school_fee;
use Illuminate\Http\Request;
use App\Models\AcademicSession;

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
    public function create()
    {

        
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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


    public function destroy(school_fee $school_fee)
    {
        //
    }
}
