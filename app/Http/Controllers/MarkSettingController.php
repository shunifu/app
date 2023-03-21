<?php

namespace App\Http\Controllers;

use App\Models\MarkSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MarkSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (!Schema::hasTable('mark_settings')) {
            Schema::create('mark_settings', function($table){
                  
                   $table->id();
                   $table->integer('marks_mode');
                   $table->timestamps();
           });
       }


        $markSettings=MarkSetting::all();



        return view('academic-admin.settings-management.marks.index', compact('markSettings'));
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

        $validation=$request->validate([
            'marks_mode'=>'required',
        ]);
     
        //Check if there is an existing value

        $checkSetting=MarkSetting::first();
       

        if (is_null($checkSetting)) {
            $add_mark=MarkSetting::create([
                'marks_mode'=>$request->marks_mode,
            ]);
        }else{
            $update=MarkSetting::first()->update([
                'marks_mode'=>$request->marks_mode,
            ]);
        }

      
        flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. Mode successfully configured.', 'Configure Mode');
        
        return redirect('/marks/settings');

       
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
