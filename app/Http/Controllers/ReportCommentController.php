<?php

namespace App\Http\Controllers;

use App\Models\ReportComment;
use Illuminate\Http\Request;

class ReportCommentController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportComment  $reportComment
     * @return \Illuminate\Http\Response
     */
    public function show(ReportComment $reportComment)
    {
        dd('j');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportComment  $reportComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportComment $reportComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportComment  $reportComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportComment $reportComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportComment  $reportComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportComment $reportComment)
    {
        //
    }
}
