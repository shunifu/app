








        //show list of classes
        //  $class


        // if($request->class_type=="internal"){

        //     //if the class type==internal then 
        //     //1. show the the third term

        //     $student_class=DB::table('grades_students')
        //     ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        //     ->join('grades','grades.id','=','grades_students.grade_id')
        //     ->join('users','users.id','=','grades_students.student_id')
        //     ->join('streams','streams.id','=','grades.stream_id')
        //     ->join('term_averages','term_averages.student_id','=','users.id')
        //     ->join('terms','terms.id','=','term_averages.term_id')
        //     ->where('grades.stream_id', $request->stream_id)
        //     ->where('grades_students.academic_session', $from_session)
        //     //->where('terms.final_term',1)
        //     ->select('users.id as student_id', 'term_averages.final_term_status as result','users.name', 'users.lastname', 'users.middlename', 'grades.id as grade_id', 'grades.grade_name', 'sequence', 'academic_sessions.academic_session')
        //     ->get();

        // }else{

        //     $student_class=DB::table('grades_students')
        //     ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        //     ->join('grades','grades.id','=','grades_students.grade_id')
        //     ->join('users','users.id','=','grades_students.student_id')
        //     ->join('streams','streams.id','=','grades.stream_id')
        //     ->where('grades.stream_id', $request->stream_id)
        //     ->where('grades_students.academic_session', $from_session)
        //     ->select('users.id as student_id', 'users.name', 'users.lastname', 'users.middlename', 'grades.id as grade_id', 'grades.grade_name', 'sequence', 'academic_sessions.academic_session')
        //     ->get();

        // }

    
         
        //   return response()->json([
        //     'status'=>200,
        //     'students'=>$student_class,

        //   ]);

        //return response()->json($student_class);

        
    
        


    //     $session=2;
    //     $previous_session=1;
     

    //     if($session==$previous_session){
    //         flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. You cannot migrate to same year', 'Migration Process Notice');

    //         return Redirect::back();
    //     }
       
    //     //deactivate old teaching loads
    //     $deactivateTeachingLoads=TeachingLoad::where('active', 1)->where('session_id', $previous_session)->update([
    //         'active'=>'0',
    //     ]);


    //      //deactivate student  loads
    //      $deactivateTeachingLoads=StudentLoad::where('active', 1)->where('session_id', $previous_session)->update([
    //         'active'=>'0',
    //     ]);

    //        $deactivateMarks=Mark::where('active', 1)->where('session_id', $previous_session)->update([
    //         'active'=>'0',
    //     ]);

    //     $students=StudentClass::where('academic_session','!=', $session)->get();//consider active==1
    //     //getting list of students who do not have the new session.

    //     foreach ($students as $key => $value) {
        
    //     $student=$value->student_id;
    //     $current_session=$value->academic_session;
    //     $current_class=$value->grade_id;

    

    //     //Check if sequence exists
    //     $class_map=ClassSequence::where('origin', $current_class)->exists();

    //     if($class_map){
    //         //if class-map exists for that class
    //         //get the next class
    //         $next_class=$class_map=ClassSequence::where('origin', $current_class)->first();
    //         $destination=$class_map->destination;

    //     }else{
    //       //else if it does not exist

    //       flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');

    //       return Redirect::back();
    //     }

    //     //make inactive each of the students in the session
    //     $deactivate=StudentClass::where('student_id', $student)->where('academic_session', $current_session)->update(['active' => '0']);        

        
    //     //create new entry.
        
    //     //1. before creating new entry check if the is a student with that session, in class and is active

    //     $studentExistsInNewSession=StudentClass::where('academic_session', $session)->where('student_id', $student)->exists();

    //     if($studentExistsInNewSession){
    //    //2. If student with $session, is in that class and is active exists then do nothing

    //     }else{

    //     //3. Else if does not exist 

    //     // check if the student passed or was promoted or failed.
      

    //     $result=DB::table('term_averages')
    //     ->join('terms','terms.id','=','term_averages.term_id')
    //     ->where('terms.academic_session', $current_session)
    //     ->where('terms.final_term', 1)->where('session_id',$current_session)->where('student_id', $student)->get();
       

    //     foreach ($result as $key => $result_value) {
    //         $status=$result_value->final_term_status;

    //         if($status=='Passed' || $status=='Promoted'){
    // // if student passed or was promoted, then add transition student to new class by adding new entry with grade_id=destination
    //             $create_new_entry=StudentClass::create([
    //                 'student_id'=>$student,
    //                 'grade_id'=>$destination,
    //                 'academic_session'=>$session,
    //                 'active'=>1,
    //                ]);
    //         }elseif($status=='Repeat'){

    //             $create_new_entry=StudentClass::create([
    //                 'student_id'=>$student,
    //                 'grade_id'=>$current_class,
    //                 'academic_session'=>$session,
    //                 'active'=>1,
    //                ]);
    //         }
    //     }

    //     flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Congratulations. You have successfully migrated students to the next class', 'Migration Process Notice');
           
    
    //     }