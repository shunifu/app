<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportTemplate;
use App\Models\ReportVariable;
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
                // $table->bigInteger('term_id');
                $table->string('report_colums');
                // $table->string('missing_marks');
                $table->timestamps();
           });
       }
        $template=ReportTemplate::all();
        return view('academic-admin.reports-management.templates.index', compact('template'));
    }

    

    public function store(Request $request){

       
        $validation=$request->validate([
            'template_name'=>'required',
            'report_columns'=>'required',
    ]);



    
        $report_template=ReportTemplate::create([
            'template_name'=>$request->template_name,
            'report_colums'=>$request->report_columns
        ]);
        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully created report template', 'Create Report Template');

        return back();
    
    

   


        
    }

    public function settings_index(){

        

    }

    public function variable(){

        if (!Schema::hasTable('report_variables')) {
            Schema::create('report_variables', function($table){
                $table->id();
                $table->string('column_color');
                $table->string('student_image')->nullable();
                $table->string('student_attendance')->nullable();
                $table->string('data_visualization')->nullable();
                $table->string('font_size')->nullable();
                $table->string('principal_signature')->nullable();
                $table->string('school_stamp')->nullable();
                $table->string('page_orientation')->nullable()->default('potrait');
                $table->timestamps();
           });
       }else{
        if (!Schema::hasColumn('variable_template_name')){
            // do something
          }
       }

      
        return view('academic-admin.reports-management.variables.index');
    }

    public function variable_store(Request $request){
     

        $validation=$request->validate([
            'column_color'=>'required',
            'student_image'=>'required',
            'student_attendance'=>'required',
            'data_visualization'=>'required',
            
            'principal_signature'=>'required',
            'school_stamp'=>'required',

    ]);

      ReportVariable::create([

        'column_color'=>$request->color,
        'student_image'=>$request->student_image,
        'student_attendance'=>$request->student_attendance,
        'data_visualization'=>$request->data_visualization,
        'font_size'=>$request->font_size,
        'principal_signature'=>$request->principal_signature,
        'school_stamp'=>$request->school_stamp,


      ]);

      flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully created report variables', 'Create Report Variables');

      return back();

    }

}
