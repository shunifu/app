<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\TimeRestriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RestrictionController extends Controller
{
    public function time_based_index(){

        if (!Schema::hasTable('time_restrictions')) {
            Schema::create('time_restrictions', function($table){
                   $table->id();
                   $table->integer('term_id');
                   $table->datetime('to');
                   $table->datetime('from');
                   $table->timestamps();
           });
       }
        $terms=Term::all();
        return view('users.parents.restriction.index', compact('terms'));

    }

    public function time_based_store(Request $request){


      $validation=$request->validate([
        'term_id'=>'required',
        'to'=>'required',
        'from'=>'required',
     

    ]);

    $term_id=$request->term_id;
    $to=$request->to;
    $from=$request->from;

    $check=TimeRestriction::where('term_id', $term_id)->where('to', $to)->where('from',$from)->exists();
 

    if(!$check){
        $insert = TimeRestriction::create([
            'term_id'=>$term_id,
            'to'=>$to,
            'from'=>$from,
    
                ]);

                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully added time range', 'Add Range');

                return redirect()->back();
    }else{
        flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Time range already exists ');
        return redirect()->back();
    }
    
    

    }
}
