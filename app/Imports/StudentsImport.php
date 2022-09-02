<?php
namespace App\Imports;
ini_set('memory_limit', '8000M');
ini_set('max_execution_time', 7800);
set_time_limit(0);


use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\StudentClass;
use App\Models\ParentStudent;
use App\Models\AcademicSession;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        if (Auth::user()->hasRole('admin_teacher')) {
            $student_role=Role::where('name', 'student')->first();
            $student_role_name=$student_role->name;

            $parent_role=Role::where('name', 'parent')->first();
            $parent_role_name=$parent_role->name;
            $academic_year=AcademicSession::where('active', 1)->first();


         
         
     
            foreach ($rows as $row) {
                // if (empty($row['student_cell'])) {
                //     $student_cell="";
                // } else {
                //     $student_cell=$row['student_cell'];
                // }
                // if (empty($row['gender'])) {
                //     $gender="";
                // } else {
                //     $student_cell=$row['student_cell'];
                // }
        
                // if (empty($row['pin'])) {
               
                // } else {
                //     $pin=$row['pin'];
                // }
                      
                $student=User::create([
                        'name'=>$row['name'],
                        'lastname'=>$row['lastname'],
                        'middlename'=>$row['middlename'],
                      //  'national_id'=>$row['pin'],
                     //   'cell_number'=>$row['student_cell'],
                       'gender'=>$row['gender'],
                        'role_id'=>$student_role->id,
                        'password'=>Hash::make(Str::random(5)),
                       ]);
          
                  
                $student->syncRoles([$student_role_name]);
                $student_id=$student->id;
                //insert into class_student
                $class_student=StudentClass::create([
        'student_id'=>$student_id,
        'grade_id'=>$row['class'],
        'academic_session'=>$academic_year->id,
       ]);

                if (empty($row['cell_number'])) {
                } else {
                    $parentExists=User::where('cell_number', $row['cell_number'])->exists();

                    if ($parentExists) {
                        $parent_data=User::where('cell_number', $row['cell_number'])->first();
            
                        $parentStudent=ParentStudent::create([
              'parent_id'=>$parent_data->id,
              'student_id'=>$student_id,
              
              ]);
                    } else {
                        //insert parent
                        $parent=User::create([
      'cell_number'=>$row['cell_number'],
      'password'=>Hash::make(Str::random(5)),
      'role_id'=>$parent_role->id,
      
     ]);
  
                        $parent->syncRoles([$parent_role_name]);
                        $parent_id=$parent->id;
  
                        //Link Parent wit Student
  
                        $parentStudent=ParentStudent::create([
  'parent_id'=>$parent_id,
  'student_id'=>$student_id,
  
  ]);
                    }
                }
            }
        }
    }
}