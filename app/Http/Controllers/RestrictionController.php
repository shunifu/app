<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\PaymentRestriction;
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

    public function payment_based_restriction_index(){

        if (!Schema::hasTable('payment_restrictions')) {
            Schema::create('payment_restrictions', function($table){
                   $table->id();
                   $table->integer('parent_id');
                   $table->integer('student_id');
                   $table->integer('payment_status');
                   $table->integer('restriction_status');
                   $table->timestamps();
           });
       }

       $grades=Grade::all();
       return view('users.parents.restriction.payments.index', compact('grades'));

    }


    public function payment_based_restriction_load(Request $request){


        $class=$request->grade_id;

        $students=DB::select(DB::raw("SELECT 
        users.id as student_id,
        users.name,
        users.middlename,
        users.lastname,
        p.cell_number as cell_number,
        grades.grade_name,
        (SELECT parents_students.parent_id as parent_id from parents_students WHERE parents_students.student_id=users.id ) as parent_id
         from grades_students
         INNER JOIN users ON grades_students.student_id=users.id  
        LEFT JOIN parents_students on parents_students.student_id=users.id
        LEFT JOIN users p ON p.id=parents_students.parent_id
        INNER JOIN grades on grades.id=grades_students.grade_id
        WHERE grades.id=$class
        ORDER BY `users`.`lastname`,  `users`.`name` ASC"));
      
       return view('users.parents.restriction.payments.load', compact('students'));

    }

    public function payment_based_restriction_store(Request $request){

        $this->validate($request,[
            'restriction_status'=>'required',
    
           ]);

          //    dd($request->all());

           $parents=$request->parents;
           $students=$request->students;
           $restriction_status=$request->restriction_status;

     

           for($i = 0; $i <count($parents); $i++) {

            $addParentRestrictions=PaymentRestriction::updateOrCreate([
            'student_id'=>$students[$i],
            'parent_id'=>$parents[$i],
            'restriction_status'=>0
            ], ['restriction_status'=>0]);

        
         }
      
         flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Congratulations. You have successfully updated info.', 'Parent Restriction');

         return redirect('/parent/restriction/payment-based');

    

        

    }
}
