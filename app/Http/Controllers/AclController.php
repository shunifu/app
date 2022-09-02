<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AclController extends Controller
{
    public function create_role(){

        $superuser = Role::create([
            'name' => 'superuser',
            'display_name' => 'superuser', // optional
            'description' => 'Superuser', // optional
        ]);
        
        $admin_teacher = Role::create([
            'name' => 'admin_teacher',
            'display_name' => 'Admin Teacher', // optional
            'description' => 'Teacher with admin privileges', // optional
        ]);

        $hod_teacher = Role::create([
            'name' => 'hod_teacher',
            'display_name' => 'hod', // optional
            'description' => 'Teacher with HOD privileges', // optional
        ]);

        $class_teacher = Role::create([
            'name' => 'class_teacher',
            'display_name' => 'Class Teacher', // optional
            'description' => 'Teacher with class teacher privileges', // optional
        ]);

        $teacher = Role::create([
            'name' => 'teacher',
            'display_name' => 'Teacher', // optional
            'description' => 'All teachers', // optional
        ]);

        $office_admin = Role::create([
            'name' => 'office_administrator',
            'display_name' => 'Office Administrator', // optional
            'description' => 'School Office Administrator', // optional
        ]);

        $bursar = Role::create([
            'name' => 'bursar',
            'display_name' => 'School Bursar', // optional
            'description' => 'School Bursar', // optional
        ]);

        $admin_bursar = Role::create([
            'name' => 'admin_bursar',
            'display_name' => 'Bursar also Office Admin', // optional
            'description' => 'Bursar also Office Admin', // optional
        ]);

        $student = Role::create([
            'name' => 'student',
            'display_name' => 'Student', // optional
            'description' => 'Student', // optional
        ]);

        $parent = Role::create([
            'name' => 'parent',
            'display_name' => 'parent', // optional
            'description' => 'parent', // optional
        ]);

        $inspector = Role::create([
            'name' => 'inspector',
            'display_name' => 'inspector', // optional
            'description' => 'inspector', // optional
        ]);

        $subject_inspector = Role::create([
            'name' => 'subject_inspector',
            'display_name' => 'subject_inspector', // optional
            'description' => 'subject_inspector', // optional
        ]);

        $auditor = Role::create([
            'name' => 'auditor',
            'display_name' => 'auditor', // optional
            'description' => 'auditor', // optional
        ]);

        $parent_teacher = Role::create([
            'name' => 'parent_teacher',
            'display_name' => 'parent_teacher', // optional
            'description' => 'parent_teacher', // optional
        ]);

        //Permssions
        
        $print_academic_report = Permission::create([
            'name' => 'print-academic-report',
            'display_name' => 'Print Report', // optional
            'description' => 'print out student reports', // optional
            ]);
            
            $print_financal_report = Permission::create([
            'name' => 'print-financial-report',
            'display_name' => 'Print Financial Report', // optional
            'description' => 'Print Out Financial Report', // optional
            ]);

            $view_financal_report = Permission::create([
                'name' => 'view-financial-report',
                'display_name' => 'View Financial Report', // optional
                'description' => 'View Financial Report', // optional
                ]);

                $view_student_report = Permission::create([
                    'name' => 'view-student-report',
                    'display_name' => 'View Student Report', // optional
                    'description' => 'View Student Report', // optional
                    ]);

            $manage_teacher = Permission::create([
                'name' => 'manage-teacher',
                'display_name' => 'Manage Teacher', // optional
                'description' => 'Manage Teacher Data', // optional
                    ]);

            $manage_student = Permission::create([
                'name' => 'manage-student',
                'display_name' => 'Manage Student', // optional
                'description' => 'Manage Student Data', // optional
                     ]);

             $assign_teacher_roles = Permission::create([
                'name' => 'assign-teacher_roles',
                'display_name' => 'Assign teacher roles ', // optional
                'description' => 'Assign teacher roles', // optional
                     ]);
            
            $manage_marks = Permission::create([
                'name' => 'manage-marks',
                'display_name' => 'Manage Marks', // optional
                'description' => 'Manage marks', // optional
                     ]);

            $manage_class = Permission::create([
                'name' => 'manage-class',
                'display_name' => 'Manage Class', // optional
                'description' => 'Manage Class', // optional
                    ]);

            $manage_department = Permission::create([
                'name' => 'manage-department',
                'display_name' => 'Manage Department', // optional
                'description' => 'Manage Department', // optional
                     ]);

            $manage_discipline = Permission::create([
                'name' => 'manage-discipline',
                'display_name' => 'Manage Discipline', // optional
                'description' => 'Manage Discipline', // optional
                    ]);

            $manage_communication = Permission::create([
                'name' => 'manage-communication',
                'display_name' => 'Manage Communication', // optional
                'description' => 'Manage Communication', // optional
                     ]);

            $manage_fees = Permission::create([
                'name' => 'manage-fees',
                'display_name' => 'Manage Fees', // optional
                'description' => 'Manage Fess', // optional
                    ]);

             $view_financial_analytics = Permission::create([
                        'name' => 'view-financial-analytics',
                        'display_name' => 'View Financial Analytics', // optional
                        'description' => 'View/Access Financial Analytics', // optional
                         ]);

             $view_school_academic_analytics = Permission::create([
                        'name' => 'view-school-academic-analytics',
                        'display_name' => 'View School Analytics', // optional
                        'description' => 'View/Access Financial Analytics', // optional
                        ]);

            $view_class_analytics = Permission::create([
                        'name' => 'view-class-analytics',
                        'display_name' => 'Class Analytics', // optional
                        'description' => 'View/Access Class Analytics', // optional
                        ]);

             $view_subject_analytics = Permission::create([
                        'name' => 'view-subject-analytics',
                        'display_name' => 'Subject Analytics', // optional
                        'description' => 'View/Access Subject Analytics', // optional
                        ]);

            $view_department_analytics = Permission::create([
                        'name' => 'view-department-analytics',
                        'display_name' => 'Department Analytics', // optional
                        'description' => 'View/Access Department Analytics', // optional
                        ]);

             $view_attendance_analytics = Permission::create([
                        'name' => 'view-attendance-analytics',
                        'display_name' => 'Attendance Analytics', // optional
                        'description' => 'View/Access Attendance Analytics', // optional
                        ]);
    
            $view_individual_analytics = Permission::create([
                        'name' => 'view-individual-analytics',
                        'display_name' => 'Individual Analytics', // optional
                        'description' => 'View/Access Individual Analytics', // optional
                         ]);

             $pay_fees = Permission::create([
                        'name' => 'pay-fees',
                        'display_name' => 'Pay Fees', // optional
                        'description' => 'Pay School Fees', // optional
                        ]);

            $create_teaching_loads = Permission::create([
                        'name' => 'create-teaching-loads',
                        'display_name' => 'Teaching Loads', // optional
                        'description' => 'Teaching Loads', // optional
                            ]);

             $edit_student = Permission::create([
                'name' => 'edit-student',
                 'display_name' => 'Edit Student', // optional
                'description' => 'Edit Student', // optional
                  ]);

                  $manage_attendance = Permission::create([
                    'name' => 'manage-attendance',
                    'display_name' => 'Manage Attendance', // optional
                    'description' => 'Manage Attendance', // optional
                        ]);

                        $view_attendance = Permission::create([
                            'name' => 'view-attendance',
                            'display_name' => 'View Attendance', // optional
                            'description' => 'View Attendance', // optional
                                ]);

                                $school_accounting = Permission::create([
                                    'name' => 'school-accounting',
                                    'display_name' => 'School Accounting', // optional
                                    'description' => 'School Accounting', // optional
                                        ]);
        



      
        //Assignment Management

    $superuser->attachPermission($print_academic_report); 
    $superuser->attachPermission($print_financal_report); 
    $superuser->attachPermission($view_attendance_analytics); 
    $superuser->attachPermission($view_financal_report); 
    $superuser->attachPermission($manage_class); 
    $superuser->attachPermission($manage_communication); 
    $superuser->attachPermission($manage_student); 
    $superuser->attachPermission($view_student_report); 
    $superuser->attachPermission($manage_teacher); 
    $superuser->attachPermission($assign_teacher_roles); 
    $superuser->attachPermission($manage_marks);   
    $superuser->attachPermission($manage_department); 
    $superuser->attachPermission($manage_discipline);  
    $superuser->attachPermission($manage_fees); 
    $superuser->attachPermission($view_school_academic_analytics);   
    $superuser->attachPermission($view_financial_analytics); 
    $superuser->attachPermission($view_class_analytics);   
    $superuser->attachPermission($view_subject_analytics);
    $superuser->attachPermission($view_department_analytics);
    $superuser->attachPermission($view_individual_analytics);
    $superuser->attachPermission($pay_fees);
    $superuser->attachPermission($create_teaching_loads);
    $superuser->attachPermission($manage_attendance);

    $admin_teacher->attachPermission($print_academic_report); 
    $admin_teacher->attachPermission($view_attendance_analytics); 
    $admin_teacher->attachPermission($manage_class); 
    $admin_teacher->attachPermission($manage_communication); 
    $admin_teacher->attachPermission($manage_student); 
    $admin_teacher->attachPermission($view_student_report); 
    $admin_teacher->attachPermission($manage_teacher); 
    $admin_teacher->attachPermission($assign_teacher_roles); 
    $admin_teacher->attachPermission($manage_marks);   
    $admin_teacher->attachPermission($manage_department); 
    $admin_teacher->attachPermission($manage_discipline);  
    $admin_teacher->attachPermission($view_school_academic_analytics);   
    $admin_teacher->attachPermission($view_class_analytics);   
    $admin_teacher->attachPermission($view_subject_analytics);
    $admin_teacher->attachPermission($view_department_analytics);
    $admin_teacher->attachPermission($view_individual_analytics);
    $admin_teacher->attachPermission($create_teaching_loads);
    $admin_teacher->attachPermission($manage_attendance);


    //Hod
    $hod_teacher->attachPermission($manage_department); 
    $hod_teacher->attachPermission($view_subject_analytics);
    $hod_teacher->attachPermission($view_department_analytics);
    $hod_teacher->attachPermission($view_individual_analytics);
    $hod_teacher->attachPermission($create_teaching_loads);
    $hod_teacher->attachPermission($manage_marks);   

    //Class Teacher
    $class_teacher->attachPermission($view_attendance_analytics); 
    $class_teacher->attachPermission($manage_class); 
    $class_teacher->attachPermission($view_subject_analytics);
    $class_teacher->attachPermission($view_individual_analytics);
    $class_teacher->attachPermission($create_teaching_loads);
    $class_teacher->attachPermission($manage_marks);   
    $class_teacher->attachPermission($manage_discipline);  
    $class_teacher->attachPermission($edit_student);  
    $class_teacher->attachPermission($manage_attendance);

     //Teacher
     $teacher->attachPermission($manage_class); 
     $teacher->attachPermission($view_subject_analytics);
     $teacher->attachPermission($view_individual_analytics);
     $teacher->attachPermission($create_teaching_loads);
     $teacher->attachPermission($manage_marks);   

     //Office Admin
     $office_admin->attachPermission($print_academic_report); 
     $office_admin->attachPermission($view_attendance_analytics); 
     $office_admin->attachPermission($manage_class); 
     $office_admin->attachPermission($manage_communication); 
     $office_admin->attachPermission($manage_student); 
     $office_admin->attachPermission($view_student_report); 
     $office_admin->attachPermission($manage_teacher); 
     $office_admin->attachPermission($assign_teacher_roles); 
     $office_admin->attachPermission($manage_marks);   
     $office_admin->attachPermission($manage_department); 
     $office_admin->attachPermission($manage_discipline);  
     $office_admin->attachPermission($view_school_academic_analytics);   
     $office_admin->attachPermission($view_class_analytics);   
     $office_admin->attachPermission($view_subject_analytics);
     $office_admin->attachPermission($view_department_analytics);
     $office_admin->attachPermission($view_individual_analytics);
 
     //Bursar
    $bursar->attachPermission($print_financal_report); 
    $bursar->attachPermission($view_financal_report); 
    $bursar->attachPermission($manage_fees);   
    $bursar->attachPermission($view_financial_analytics); 
    $bursar->attachPermission($school_accounting); 

    //Parent
    $parent->attachPermission($view_attendance_analytics); 
    $parent->attachPermission($view_student_report); 
    $parent->attachPermission($pay_fees);
    $parent->attachPermission($view_attendance);
  
     //Parent-Teacher
     $parent_teacher->attachPermission($view_attendance_analytics); 
     $parent_teacher->attachPermission($view_student_report); 
     $parent_teacher->attachPermission($pay_fees);
     $parent_teacher->attachPermission($view_attendance);
     $parent_teacher->attachPermission($manage_class); 
     $parent_teacher->attachPermission($view_subject_analytics);
     $parent_teacher->attachPermission($view_individual_analytics);
     $parent_teacher->attachPermission($create_teaching_loads);
     $parent_teacher->attachPermission($manage_marks);   

    


    }

    public function create_permission(){

        $print_academic_report = Permission::create([
            'name' => 'print-academic-report',
            'display_name' => 'Print Report', // optional
            'description' => 'print out student reports', // optional
            ]);
            
            $print_financal_report = Permission::create([
            'name' => 'print-financial-report',
            'display_name' => 'Print Financial Report', // optional
            'description' => 'Print Out Financial Report', // optional
            ]);

            $view_financal_report = Permission::create([
                'name' => 'view-financial-report',
                'display_name' => 'View Financial Report', // optional
                'description' => 'View Financial Report', // optional
                ]);

                $view_student_report = Permission::create([
                    'name' => 'view-student-report',
                    'display_name' => 'View Student Report', // optional
                    'description' => 'View Student Report', // optional
                    ]);

            $manage_teacher = Permission::create([
                'name' => 'manage-teacher',
                'display_name' => 'Manage Teacher', // optional
                'description' => 'Manage Teacher Data', // optional
                    ]);

            $manage_student = Permission::create([
                'name' => 'manage-student',
                'display_name' => 'Manage Student', // optional
                'description' => 'Manage Student Data', // optional
                     ]);

             $assign_teacher_roles = Permission::create([
                'name' => 'assign-teacher_roles',
                'display_name' => 'Assign teacher roles ', // optional
                'description' => 'Assign teacher roles', // optional
                     ]);
            
            $manage_marks = Permission::create([
                'name' => 'manage-marks',
                'display_name' => 'Manage Marks', // optional
                'description' => 'Manage marks', // optional
                     ]);

            $manage_class = Permission::create([
                'name' => 'manage-class',
                'display_name' => 'Manage Class', // optional
                'description' => 'Manage Class', // optional
                    ]);

                  
            $manage_department = Permission::create([
                'name' => 'manage-department',
                'display_name' => 'Manage Department', // optional
                'description' => 'Manage Department', // optional
                     ]);

            $manage_discipline = Permission::create([
                'name' => 'manage-discipline',
                'display_name' => 'Manage Discipline', // optional
                'description' => 'Manage Discipline', // optional
                    ]);

            $manage_communication = Permission::create([
                'name' => 'manage-communication',
                'display_name' => 'Manage Communication', // optional
                'description' => 'Manage Communication', // optional
                     ]);

            $manage_fees = Permission::create([
                'name' => 'manage-fees',
                'display_name' => 'Manage Fees', // optional
                'description' => 'Manage Fess', // optional
                    ]);

             $view_financial_analytics = Permission::create([
                        'name' => 'view-financial-analytics',
                        'display_name' => 'View Financial Analytics', // optional
                        'description' => 'View/Access Financial Analytics', // optional
                         ]);

             $view_school_academic_analytics = Permission::create([
                        'name' => 'view-school-academic-analytics',
                        'display_name' => 'View School Analytics', // optional
                        'description' => 'View/Access Financial Analytics', // optional
                        ]);

            $view_class_analytics = Permission::create([
                        'name' => 'view-class-analytics',
                        'display_name' => 'Class Analytics', // optional
                        'description' => 'View/Access Class Analytics', // optional
                        ]);

             $view_subject_analytics = Permission::create([
                        'name' => 'view-subject-analytics',
                        'display_name' => 'Subject Analytics', // optional
                        'description' => 'View/Access Subject Analytics', // optional
                        ]);

            $view_department_analytics = Permission::create([
                        'name' => 'view-department-analytics',
                        'display_name' => 'Department Analytics', // optional
                        'description' => 'View/Access Department Analytics', // optional
                        ]);

             $view_attendance_analytics = Permission::create([
                        'name' => 'view-attendance-analytics',
                        'display_name' => 'Attendance Analytics', // optional
                        'description' => 'View/Access Attendance Analytics', // optional
                        ]);
    
            $view_individual_analytics = Permission::create([
                        'name' => 'view-individual-analytics',
                        'display_name' => 'Individual Analytics', // optional
                        'description' => 'View/Access Individual Analytics', // optional
                         ]);

             $pay_fees = Permission::create([
                        'name' => 'pay-fees',
                        'display_name' => 'Pay Fees', // optional
                        'description' => 'Pay School Fees', // optional
                        ]);

            $create_teaching_loads = Permission::create([
                        'name' => 'create-teaching-loads',
                        'display_name' => 'Teaching Loads', // optional
                        'description' => 'Teaching Loads', // optional
                            ]);


    }

    public function assign(){
        $user=Auth::user();
        
        $user->attachRole('superuser');

        $user->attachPermissions(['manage-teacher','manage-student','print-academic-report','print-financial-report','view-financial-report','view-student-report','assign-teacher_roles', 'manage-marks','manage-class', 'manage-department', 'manage-communication','manage-discipline','manage-fees','view-financial-analytics', 'view-school-academic-analytics','view-class-analytics','view-subject-analytics','view-department-analytics','view-individual-analytics','manage-attendance','school-accounting']);
      
    return 'added';

    }

    public function elearning(){

        $createLesson= Permission::create([
            'name' => 'create-lesson',
            'display_name' => 'Create Lessons', // optional
            'description' => 'Allows teachers to add lessons', // optional
            ]);

            $manageLesson= Permission::create([
                'name' => 'manage-lesson',
                'display_name' => 'Manage Lessons', // optional
                'description' => 'Allows teachers to manage lessons', // optional
                ]);

                $viewLessons= Permission::create([
                    'name' => 'view-lesson',
                    'display_name' => 'view Lessons', // optional
                    'description' => 'Allows students to view lessons', // optional
                    ]);

                    $makeSubmissions= Permission::create([
                        'name' => 'manage-lesson',
                        'display_name' => 'Manage Lessons', // optional
                        'description' => 'Allows students to make lesson submissions', // optional
                        ]);
    

               
    }

  
}

