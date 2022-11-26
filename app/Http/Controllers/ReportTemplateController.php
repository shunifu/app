<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportTemplate;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class ReportTemplateController extends Controller
{



    public function index(){

        if (!Schema::hasTable('report_templates')) {
            Schema::create('report_templates', function($table){
                $table->id();
                $table->string('template_name');
                $table->string('class_type');
                $table->bigInteger('term_id');
                $table->string('report_colums');
                $table->string('missing_marks');
                $table->timestamps();
           });
       }
        $template=ReportTemplate::all();
        return view('academic-admin.reports-management.templates.index', compact('template'));
    }

    

    public function store(Request $request){

       
        $validation=$request->validate([
            'template_name'=>'required',
    ]);


    //check if the is item in the database

    if (ReportTemplate::exists()) {
      
        ReportTemplate::query()->update(['template_name' => $request->template_name ]);
       
        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully updated report template', 'Apply Report Template');
        return back();


    } else {
        $report_template=ReportTemplate::create([
            'template_name'=>$request->template_name,
        ]);
        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully applied report template', 'Apply Report Template');

        return back();
    
    }

   


        
    }

    public function settings_index(){

        

    }

    public function variable(){
        return view('academic-admin.reports-management.variables.index');
    }

}
