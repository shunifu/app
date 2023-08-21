<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportTemplate;
use App\Models\ReportVariable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use phpseclib3\Crypt\RC2;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\Constraint\IsNull;


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


    public function edit($id){

        $template=ReportTemplate::find(decrypt($id));
    

        return view('academic-admin.reports-management.templates.edit', compact('template'));

    }

    public function update(Request $request){

    

        $validation=$request->validate([
            'template_name'=>'required',
            'report_columns'=>'required',
    ]);

    $template_id=$request->template_id;
    
    $update=ReportTemplate::find($template_id)->update([

        "template_name"=>$request->template_name,
        "report_colums"=>$request->report_columns,


    ]);

    flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully updated report template', 'Update Report Template');

    return back();

    }


    public function destroy($id){

        $template=ReportTemplate::find(decrypt($id))->delete();

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully deleted report template', 'Delete Report Template');

        return back();

    }

   

    public function variable(){

        if (!Schema::hasTable('report_variables')) {
            Schema::create('report_variables', function($table){
                $table->id();
                $table->string('column_color');
                $table->string('student_image')->nullable();
                $table->string('student_attendance')->nullable();
                $table->string('data_visualization')->nullable();
                $table->string('term_position')->nullable();
                $table->string('subject_position')->nullable();
                $table->string('subject_average')->nullable();
                $table->string('font_size')->nullable();
                $table->string('principal_signature')->nullable();
                $table->string('school_stamp')->nullable();
                $table->string('page_orientation')->nullable()->default('potrait');
                $table->timestamps();
           });
       }

       if (!Schema::hasColumn('report_variables', 'subject_position')) //check the column
       {
           Schema::table('report_variables', function (Blueprint $table)
           {
              
            $table->string('term_position')->nullable();
            $table->string('subject_position')->nullable();
            $table->string('subject_average')->nullable();
           });
       }


       
       $variables=ReportVariable::all();
       $variablescount=ReportVariable::count();

    //    dd($variables);

       
       if (($variablescount==0)) {
       $status=0;
       } else {
        $status=1;
       }
             
        return view('academic-admin.reports-management.variables.index', compact('variables', 'status'));
    }

    public function variable_store(Request $request){
     

        $validation=$request->validate([
            //$column_color=>'required'

    ]);

      ReportVariable::create([

        'column_color'=>$request->color,
        'student_image'=>$request->student_image,
        'student_attendance'=>$request->attendance_data,
        'data_visualization'=>$request->data_visualization,
        'term_position'=>$request->term_position,
        'subject_position'=>$request->subject_position,
        'subject_average'=>$request->subject_average,
        'font_size'=>$request->font_size,
        'principal_signature'=>$request->principal_signature,
        'school_stamp'=>$request->school_stamp,
        'page_orientation'=>$request->page_orientation,


      ]);

      flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully created report variables', 'Create Report Variables');

      return back();

    }


    public function variable_update(Request $request){


        $id=$request->id;

        ReportVariable::find($id)->update([

            'column_color'=>$request->color,
            'student_image'=>$request->student_image,
            'student_attendance'=>$request->attendance_data,
            'data_visualization'=>$request->data_visualization,
            'term_position'=>$request->term_position,
            'subject_position'=>$request->subject_position,
            'subject_average'=>$request->subject_average,
            'font_size'=>$request->font_size,
            'principal_signature'=>$request->principal_signature,
            'school_stamp'=>$request->school_stamp,
            'page_orientation'=>$request->page_orientation,
          ]);

          flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully updated report variables', 'Update Report Variables');

          return back();

    }

}
