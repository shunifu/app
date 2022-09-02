<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){

        $collection_section=Section::all();
        return view('academic-admin.class-management.add-section', compact('collection_section'));
    }

    public function store(Request $request){
        $validation=$request->validate([
            'section_name'=>'required|unique:sections'
        ]);
    

        $section_name=$request->input('section_name');
        Section::create([
            'section_name' => $section_name,
        ]);

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added section', 'Add Section');
            return redirect()->back();

    }
}
