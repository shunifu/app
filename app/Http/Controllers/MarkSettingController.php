<?php

namespace App\Http\Controllers;

use App\Models\MarkSetting;
use Illuminate\Database\Schema\Blueprint;
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


       if (!Schema::hasColumn('mark_settings', 'effort_grade_status')) {
        
        Schema::table('mark_settings', function (Blueprint $table) {

            $table->integer('effort_grade_status')->default('0');
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

     //   dd($request->all());

        $validation=$request->validate([
            'marks_mode'=>'required',
            'effort_grade_status'=>'required',
        ]);
     
        //Check if there is an existing value

        $checkSetting=MarkSetting::first();
       

        if (is_null($checkSetting)) {
            MarkSetting::create([
                'marks_mode'=>$request->marks_mode,
                'effort_grade_status'=>$request->effort_grade_status,
            ]);
        }else{
            $update=MarkSetting::first()->update([
                'marks_mode'=>$request->marks_mode,
                'effort_grade_status'=>$request->effort_grade_status,
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
