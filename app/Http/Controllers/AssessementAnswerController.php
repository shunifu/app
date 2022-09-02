<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessementAnswerController extends Controller
{
    public function store(Request $request){
        
    
        $validation=$request->validate([
            'subject_name'=>'required',
            'subject_type'=>'required'
        ]);

    }
}
