<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
	public function create()
	{

		$school_info = School::all();
	
		if(($school_info)->isEmpty()){
			return view('academic-admin.settings-management.school-settings');
		}else{
			return view('academic-admin.settings-management.edit-school', compact('school_info'));	
		}
		
		
	}


	public function store(Request $request){
		$isAdmin= Auth::user()->hasRole('school_admin');
        $isAdminTeacher= Auth::user()->hasRole('admin_teacher');

		//Create tenant
		//add env varibles
			//-db
			//google api oauth
			//sms api
			//cloudinary

	// /	dd($request->all());
        if($isAdminTeacher OR $isAdmin){
            $school_name=$request->school_name;
            $school_slogan=$request->school_slogan;
            $school_code=$request->school_code;
            $school_type=$request->school_type;
            $school_number=$request->school_number;
            $school_email=$request->school_email;
			$school_logo=$request->school_logo;
			$school_letter_head=$request->school_letter_head;
			$school_background=$request->background_image;
			$school_domain=$request->school_code.'.shunifu.app';

		if($request->hasFile('school_logo')){
			
				// $school_logo_file = 'logo_'.$school_code.'.'.$school_code->extension();  
				$logo_result = $request->file('school_logo')->storeOnCloudinaryAs('shunifu', 'logo_'.$school_code);
				$school_logo_file=$logo_result->getSecurePath();
			}else{
				$school_logo_file="";
			}

			if($request->hasFile('school_letter_head')){

				$letter_head_result = $request->file('school_letter_head')->storeOnCloudinaryAs('shunifu', 'letter_head_'.$school_code);
				$letterhead_file=$letter_head_result->getSecurePath();
				
			}else{
				$letterhead_file="";
			}


			if($request->hasFile('background_image')){
				
				$background_image_result = $request->file('background_image')->storeOnCloudinaryAs('shunifu', 'background_image'.$school_code);
				$background_file=$background_image_result->getSecurePath();
			}else{
				$background_file="";
			}

			
		
				$create=School::create([
                    'school_code'=>$school_code,
                    'school_name'=>$school_name,
                    'school_slogan'=>$school_slogan,
                    'school_type'=>$school_type,
                    'school_telephone'=>$school_number,
					'school_domain'=>$school_domain,
					'school_email'=>$school_email,
					'school_logo'=>$school_logo_file,
					'school_letter_head'=>$letterhead_file,
					'school_background_image'=>$background_file,
                ]);


				if ($create) {

				 flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added School Information', 'Add School');
				}else{
					flash()->overlay('Failed. School not added', 'Add School');
				}

			



        

        return redirect()->back();
    }
}  


	public function edit(Request $request){


		//validation

		// $validation=$request->validate([
        //     'school_name'=>'required',
        //     'school_slogan'=>'required',
        //     'school_code'=>'required|integer',
		// 	'school_type'=>'required',
		// 	'school_number'=>'required|integer',
		// 	'school_email'=>'required|email',
		

        // ]);

		// dd($request->all());

		// "_token" => "PNWVIGP8P4tncnCqK5VrT6sDxme9uGR4CEm876me"
		// "school_name" => "Demo School"
		// "school_slogan" => "Innovative School"
		// "school_code" => "555"
		// "school_type" => "high-school"
		// "school_number" => "23441012"
		// "school_email" => "info@shunifu.app"
		// "school_logo" => null
		// "school_letter_head" => null
		// "background_image" => null
		// "id" => "1"
	
		// dd($request->all());
		$id=$request->id;
	
		$school_code=$request->school_code;
		
		$school=School::find($id);

		if($request->hasFile('school_logo')){
			
			$logo_result = $request->file('school_logo')->storeOnCloudinaryAs('shunifu', 'logo_'.$school_code);
			$school_logo_file=$logo_result->getSecurePath();
		}else{
			$school_logo_file=$school->school_logo;
		}

		if($request->hasFile('school_letter_head')){

			$letter_head_result = $request->file('school_letter_head')->storeOnCloudinaryAs('shunifu', 'letter_head_'.$school_code);
			$letterhead_file=$letter_head_result->getSecurePath();
			
		}else{
			$letterhead_file=$school->school_letterhead;
		}


		if($request->hasFile('background_image')){
				
			$background_image_result = $request->file('background_image')->storeOnCloudinaryAs('shunifu', 'background_image'.$school_code);
			$background_file=$background_image_result->getSecurePath();
		//	dd($background_file);
		}else{
			$background_file="";
		}
			// "_token" => "PNWVIGP8P4tncnCqK5VrT6sDxme9uGR4CEm876me"
		// "school_name" => "Demo School"
		// "school_slogan" => "Innovative School"
		// "school_code" => "555"
		// "school_type" => "high-school"
		// "school_number" => "23441012"
		// "school_email" => "info@shunifu.app"
		// "school_logo" => null
		// "school_letter_head" => null
		// "background_image" => null
		// "id" => "1"

		// 'school_code'=>$school_code,
		// 'school_name'=>$school_name,
		// 'school_slogan'=>$school_slogan,
		// 'school_type'=>$school_type,
		// 'school_telephone'=>$school_number,
		// 'school_domain'=>$school_domain,
		// 'school_email'=>$school_email,
		// 'school_logo'=>$school_logo_file,
		// 'school_letter_head'=>$letterhead_file,
		// 'school_background_image'=>$background_file,

		$school_name=$request->school_name;
		$school_slogan=$request->school_slogan;
		$school_code=$request->school_code;
		$school_type=$request->school_type;
		$school_number=$request->school_number;
		$school_email=$request->school_email;
		$school_logo=$request->school_logo;
		$school_letter_head=$request->school_letter_head;
		$school_background=$request->background_image;
		$school_domain=$request->school_code.'.shunifu.app';


	$update=School::find($id)->update(['school_code'=>$request->school_code, 
	'school_code'=>$school_code,
	'school_name'=>$school_name,
	'school_slogan'=>$school_slogan,
	'school_type'=>$school_type,
	'school_telephone'=>$school_number,
	'school_domain'=>$school_domain,
	'school_email'=>$school_email,
	'school_logo'=>$school_logo_file,
	'school_letter_head'=>$letterhead_file,
	'school_background_image'=>$background_file
]);

		flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. You have successfully updated school information', 'Edit School Information');

        return redirect()->back();
	}
}
