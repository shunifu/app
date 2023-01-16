<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentHead;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    public function create(){

        if(Auth::user()->hasRole('admin_teacher')){

            $collection_department=Department::all();
            $teacher_role=Role::where('name', 'teacher')->first()->id;
            $admin_teacher_role=Role::where('name', 'admin_teacher')->first()->id;
           
            $teachers=User::where('role_id', $teacher_role, $admin_teacher_role)->get();

    
            $department_collection=DB::table('departments')
            ->leftjoin('department_heads','department_heads.department_id','=','departments.id')
            ->leftjoin('users','users.id','=','department_heads.teacher_id')
        
            ->select('departments.id as department_id','department_heads.id as department_head_id', 'department_name', 'name', 'salutation', 'middlename', 'lastname')
            ->get();

           
           
            return view('academic-admin.department-management.add', compact('collection_department', 'teachers', 'department_collection'));
            
        }else{
            return view('errors.unauthorized');
        }

       

    }

    public function add_teachers(){
        //Add teachers to department
        $isAdmin=Auth::user()->hasRole('admin_teacher');
        $isHOD=Auth::user()->hasRole('hod');

        $teacher_role=Role::where('name', 'teacher')->first()->id;
        $admin_teacher_role=Role::where('name', 'admin_teacher')->first()->id;
        $teachers=User::where('role_id', $teacher_role,$admin_teacher_role )->get();


    if($isAdmin){
        $department=Department::all();
        return view('academic-admin.department-management.add-teacher', compact('teachers', 'department'));

    }else if($isHOD){
        $department=DepartmentHead::where('teacher_id', Auth::user()->id)->get();
        return view('academic-admin.department-management.add-teacher', compact('teachers', 'department'));
    }
} 

    public function store(Request $request){


        $validation=$request->validate([
            'department_name'=>'required',
            'teacher'=>'required',
        ]);

   

            $department_name=$request->input('department_name');
            $department_exists=Department::where('department_name', $department_name)->exists();
    
            $teacher_exists=DepartmentHead::where('teacher_id', $request->teacher)->exists();
            
    
            if($department_exists){
                flash()->overlay('<i class="fas fa-check-circle text-danger "></i>'.' Error .The department '.$department_name.' you have just added exists in the system', 'Add Department');
        
                return Redirect::back();
            }elseif($teacher_exists){

                flash()->overlay('<i class="fas fa-check-circle text-danger "></i>'.' Error. The Teacher you have just added is already an HOD','Add Department'); 
                return Redirect::back();
    
            }else{

           $add_department=Department::create([
                'department_name' => $department_name,
            ]);
    
            $department_id=$add_department->id;
            $hod_role=Role::where('name', 'hod_teacher')->first();
            $hod_name=$hod_role->name;

            if( $hod=DepartmentHead::create([ 'department_id'=>$department_id,  'teacher_id'=>$request->teacher ])){
             $hod->syncRoles([$hod_name]);

            flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. Department successfully added.', 'Add Department');
        
            return redirect('academic-admin/department');
    
            }else{
    
                flash()->overlay('<i class="fas fa-check-circle text-danger "></i>'.' Failed. Could not add Department.', 'Add Department');
        
                return redirect('academic-admin/department');
    
            }
    
            
        }
 

    }

 public function edit($id){
    $department_data=Department::where('id', $id)->first();

    $department_head=DepartmentHead::where('department_id', $id)->first();

    $teacher_role=Role::where('name', 'teacher')->first()->id;
   
    $teachers=User::where('role_id', $teacher_role )->get();

    $hod=DB::table('department_heads')
    ->join('users','users.id','=','department_heads.teacher_id')
    ->where('department_heads.department_id',$id )
    ->select('department_heads.id as department_head_id','users.id as id', 'name', 'salutation', 'middlename', 'lastname')
    ->first();
   

   if ((!$hod>0)) {
    $teacher_id=0;

    $dept=DB::table('departments')
    ->where('departments.id',$id )
    ->first();
    $int=0;
    $department_id=$dept->id;
   }else{
    $int=1;
    $teacher_id=$hod->id;
    $department_id=$hod->department_head_id;
   }
  
 

    return view('academic-admin.department-management.edit', compact('department_data', 'department_head', 'teachers', 'hod', 'department_id', 'teacher_id', 'int'));
 }



 public function update(Request $request){
  
    $hod_role=Role::where('name', 'hod_teacher')->first();
    $hod_name=$hod_role->name;

    $current_teacher=$request->current_teacher_id;
    $department_id=$request->current_department_id;
    $department_name=$request->department;
    $new_teacher=$request->new_teacher;

   


$updateDepartment=Department::where('id', $department_id)->update([
    "department_name"=>$department_name,
]);

$updateDepartmentHead=DepartmentHead::where('teacher_id', $current_teacher)->update([
    "teacher_id"=>$new_teacher,
]);

//remove role in current teacher
User::where('id',$current_teacher)->first()->detachRole($hod_name); 


//add role in new teacher

User::where('id',$new_teacher)->first()->attachRole($hod_name); 

flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. Department successfully updated.', 'Update Department');
        
return redirect('academic-admin/department');

 }

    public function destroy($id, $department){
    //Delete department
    if(Auth::user()->hasRole('admin_teacher')){

        //Delete department_head
    $school_department=Department::find($department);
    $department_head=DepartmentHead::find($id);
    if($department_head->delete()){
       
        $school_department->delete(); 

        flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. You have deleted the '.$school_department->department_name.'.', 'Delete Department');
    
        return redirect('academic-admin/department');
    }else{
        flash()->overlay('<i class="fas fa-check-circle text-danger "></i>'.' Failed. Could not delete Department.', 'Delete Department');
    
        return redirect('academic-admin/department');
    }

 


    }else{
        return view('errors.unauthorized');
    }
}
}
