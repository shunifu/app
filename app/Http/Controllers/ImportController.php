<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{



    public function teacher_form(){

        return view('users.teachers.import');
    }

    public function teachers(){



        Excel::import(new TeachersImport, 'users.xlsx');
        
        return redirect('/')->with('success', 'All good!');

    }
}
