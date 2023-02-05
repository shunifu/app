<?php

namespace App\Http\Controllers;

use App\Models\MarkSetting;
use Illuminate\Http\Request;

class MarkSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('se')
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
     * @param  \App\Models\MarkSetting  $markSetting
     * @return \Illuminate\Http\Response
     */
    public function show(MarkSetting $markSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarkSetting  $markSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(MarkSetting $markSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MarkSetting  $markSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarkSetting $markSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarkSetting  $markSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarkSetting $markSetting)
    {
        //
    }
}
