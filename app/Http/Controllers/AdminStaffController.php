<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStaffController extends Controller
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
        $bursar=Role::where('name', 'bursar')->get();
        $office_administrator=Role::where('name', 'office_administrator')->get();
        $admin_bursar=Role::where('name', 'admin_bursar')->get();
    
        return view('users.support.index', compact('bursar', 'office_administrator', 'admin_bursar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $otp=Str::random(24);
        $support_staff = User::create([ 
            'name'=>$request->first_name,
            'salutation'=>$request->salutation,
            'middlename'=>$request->middle_name,
            'lastname'=>$request->last_name,
            'national_id'=>$request->national_id,
            'date_of_birth'=>$request->date_of_birth,
            'gender'=>$request->gender,
            'cell_number'=>$request->cell_number,
            'email'=>$request->email_address,
            'password'=>Hash::make($otp),
            'role_id'=>$request->role_id,
            'status'=>1,
            
       ]);
       $support_staff->attachRole($request->role_id);
       return 'success'.' '.$otp;
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
