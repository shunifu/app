<?php

namespace App\Http\Controllers;

use App\Models\VirtualClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VirtualClassController extends Controller
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
        $teaching_loads=DB::table('teaching_loads')
        ->join('users','teaching_loads.teacher_id','=','users.id')
        ->join('subjects','teaching_loads.subject_id','=','subjects.id')
        ->join('grades','teaching_loads.class_id','=','grades.id')
        ->where('teaching_loads.teacher_id', Auth::user()->id )
        ->select('subject_name','grade_name', 'name', 'teaching_loads.id')
        ->orderBy('teaching_loads.created_at', 'ASC')
        ->get();
        
        return view('online-learning.virtual-class', compact('teaching_loads'));
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
     * @param  \App\Models\VirtualClass  $virtualClass
     * @return \Illuminate\Http\Response
     */
    public function show(VirtualClass $virtualClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VirtualClass  $virtualClass
     * @return \Illuminate\Http\Response
     */
    public function edit(VirtualClass $virtualClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VirtualClass  $virtualClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VirtualClass $virtualClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VirtualClass  $virtualClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(VirtualClass $virtualClass)
    {
        //
    }
}
