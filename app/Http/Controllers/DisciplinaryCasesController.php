<?php

namespace App\Http\Controllers;

use App\Models\DisciplinaryCases;
use Illuminate\Http\Request;

class DisciplinaryCasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DisciplinaryCases  $disciplinaryCases
     * @return \Illuminate\Http\Response
     */
    public function show(DisciplinaryCases $disciplinaryCases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DisciplinaryCases  $disciplinaryCases
     * @return \Illuminate\Http\Response
     */
    public function edit(DisciplinaryCases $disciplinaryCases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DisciplinaryCases  $disciplinaryCases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DisciplinaryCases $disciplinaryCases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DisciplinaryCases  $disciplinaryCases
     * @return \Illuminate\Http\Response
     */
    public function destroy(DisciplinaryCases $disciplinaryCases)
    {
        //
    }
}
