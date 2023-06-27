<?php

namespace App\Http\Controllers;

use App\Models\ShunifuService;
use Illuminate\Http\Request;

class ShunifuServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rstp_index()
    {
        return view('shunifu-services.rstp.index');
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
     * @param  \App\Models\ShunifuService  $shunifuService
     * @return \Illuminate\Http\Response
     */
    public function show(ShunifuService $shunifuService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShunifuService  $shunifuService
     * @return \Illuminate\Http\Response
     */
    public function edit(ShunifuService $shunifuService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShunifuService  $shunifuService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShunifuService $shunifuService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShunifuService  $shunifuService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShunifuService $shunifuService)
    {
        //
    }
}
