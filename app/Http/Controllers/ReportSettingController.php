<?php

namespace App\Http\Controllers;

use App\Models\ReportSetting;
use Illuminate\Http\Request;

class ReportSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
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
     * @param  \App\Models\ReportSetting  $reportSetting
     * @return \Illuminate\Http\Response
     */
    public function show(ReportSetting $reportSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportSetting  $reportSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportSetting $reportSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportSetting  $reportSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportSetting $reportSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportSetting  $reportSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportSetting $reportSetting)
    {
        //
    }
}
