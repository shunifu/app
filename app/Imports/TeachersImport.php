<?php
namespace App\Imports;
ini_set('memory_limit', '8000M');
ini_set('max_execution_time', 7800);
set_time_limit(0);


use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        if(Auth::user()->hasRole('admin_teacher')){
            $teacher_role=Role::where('name', 'teacher')->first();
            $teacher_name=$teacher_role->name;
           
            $otp =  mt_rand(1000,9999);
            foreach ($rows as $row){
      $teacher=User::create([
            'user_code' =>$row['code'], 
            'salutation'=>$row['salutation'],
            'name'=> $row['name'], 
            'lastname'=> $row['lastname'], 
            'middlename'=> $row['middlename'], 
            'cell_number'=> $row['cell_number'], 
            'email'=> $row['email_address'], 
            'role_id'=>$teacher_role->id, 
            'password'=>Hash::make($otp),
         ]);

        
         $teacher->syncRoles([$teacher_name]);

      }

        

      

        }
    }
}
