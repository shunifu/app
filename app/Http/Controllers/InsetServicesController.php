<?php

namespace App\Http\Controllers;

use App\Models\insetServices;
use Illuminate\Http\Request;

class InsetServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workshop_index()
    {
        return view('')
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
     * @param  \App\Models\insetServices  $insetServices
     * @return \Illuminate\Http\Response
     */
    public function show(insetServices $insetServices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\insetServices  $insetServices
     * @return \Illuminate\Http\Response
     */
    public function edit(insetServices $insetServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\insetServices  $insetServices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, insetServices $insetServices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\insetServices  $insetServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(insetServices $insetServices)
    {
        //
    }
}
