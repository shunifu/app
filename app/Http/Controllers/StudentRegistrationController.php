<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=Grade::where('stream_id', 5)->get();
        return view('users.students.register', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
            'email' => 'required|email'
         ]);
         $id=$request->student_id;
         $email_address=$request->email;

         User::find($id)->update(['email'=>$email_address]);
         

         flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. Email Added', 'Add Email');
     
         return redirect('/student/register/')->with('status','Email Successfully Added.');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
        $name=strtoupper($request->name);
       
        $lastname=strtoupper($request->lastname);
        $class=strtoupper($request->student_class);

        $get_students=DB::table('users')
        ->join('grades_students','grades_students.student_id','=','users.id')
        ->where('users.name', $name)
        ->where('users.lastname', $lastname)
        ->where('grades_students.grade_id', $class)
        ->whereNull('email')
        ->select('users.id as student_id','users.name', 'users.name', 'users.middlename', 'users.lastname')
        ->get();


        return view('users.students.register-show', compact('get_students'));
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
