<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class CoronaSurvellianceController extends Controller
{
    public function index_students(){
        //students
        //$classes=Grade::all();

        return view('covid-19-survelliance.students.index');
    }

    public function index_visitors(){
        //visitors
    }

    public function index_teachers(){
        //teachers
    }

    public function index_support_staff(){
        //teachers
    }
}

