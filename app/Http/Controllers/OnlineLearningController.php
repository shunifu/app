<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mark;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Assessement;
use App\Models\StudentLoad;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use App\Models\ParentStudent;
use App\Models\StudentLesson;
use App\Models\lesson_student;
use App\Models\OnlineLearning;
use App\Models\StudentResponse;
use BeyondCode\Comments\Comment;
use App\Models\AssessementOnline;
use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Auth;
use App\Models\OnlineAssessementResult;
use Illuminate\Support\Facades\Redirect;

class OnlineLearningController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 * 
	 * 
	 */

	
	public function index($id)
	{


		$lesson = DB::table('lessons')
			->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
			->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
			->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
			->join('users', 'teaching_loads.teacher_id', '=', 'users.id')
			->select('lessons.*', 'users.name', 'users.lastname', 'users.middlename', 'users.profile_photo_path', 'teaching_loads.id as teaching_load_id', 'teaching_loads.class_id', 'grades.grade_name', 'subjects.id as subject_id', 'subjects.subject_name as subject_name')
			->where('lessons.id', $id)
			->first();

			$objectives=lesson::where('id', $id)->first('lesson_objectives')->toArray();
			

		$comments = DB::table('lesson_comments')
			->join('users', 'users.id', '=', 'lesson_comments.user_id')
			->where('lesson_id', $id)
			->select('lesson_comments.created_at as comment_time','lesson_comments.comment','lesson_comments.path', 'users.*')
			->get();

		return view('online-learning.view', compact('lesson', 'comments', 'objectives'));
	}

	public function student_view($id)
	{

		$lesson = DB::table('lessons')
		->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
		->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
		->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
		->join('users', 'teaching_loads.teacher_id', '=', 'users.id')
		->select('lessons.*', 'users.name', 'users.lastname', 'users.middlename', 'users.profile_photo_path', 'teaching_loads.id as teaching_load_id', 'teaching_loads.class_id', 'grades.grade_name', 'subjects.id as subject_id', 'subjects.subject_name as subject_name')
		->where('lessons.id', $id)
		->first();

		$objectives=lesson::where('id', $id)->first('lesson_objectives')->toArray();

		

			$comments = DB::table('lesson_comments')
			->join('users', 'users.id', '=', 'lesson_comments.user_id')
			->where('lesson_id', $id)
			->select('lesson_comments.created_at as comment_time','lesson_comments.comment','lesson_comments.path', 'users.*')
			->get();

		return view('online-learning.student_view', compact('lesson', 'comments','objectives'));
	}

	/**
	 * Show the form for creating a new resource.,'
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()

	{

		$user = Auth::user();

		if ($user->hasRole('teacher')) {

			$result_load = DB::table('teaching_loads')
				->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
				->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
				->where('teaching_loads.teacher_id', Auth::user()->id)
				->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
				->get();
				
				

			return view('online-learning.index', compact('result_load'));
		} else {
			return view('errors.unauthorized');
		}
	}

	public function zoom(Request $request)
	{

		$r = Zoom::meeting()->make([
			'topic' => 'New meeting',
			'type' => 8,
			'start_time' => new Carbon('2020-08-12 10:00:00'), // best to use a Carbon instance here.
		]);
		dd($r);
		$result_load = DB::table('teaching_loads')
			->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
			->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
			->where('teaching_loads.teacher_id', Auth::user()->id)
			->select('grade_name', 'subject_name', 'teaching_loads.id')
			->get();


		return view('online-learning.zoom', compact('result_load'));
	}

	public function zoom_store(Request $request)
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{

		

		if (Auth::user()->hasRole('teacher')) {

			//validations
		
		$teaching_load = $request->teaching_load;
		$students = StudentLoad::where('teaching_load_id', $teaching_load)->pluck('student_id')->toArray();


	$objectives=json_encode($request->lesson_objectives);
		$lesson = Lesson::create([

			'lesson_title' => $request->lesson_title,
			'lesson_content' => $request->content,
			'topic_id'=>$request->topic_id,
			'teaching_load_id' => $teaching_load,
			'lesson_overview' => $request->lesson_overview,
			'lesson_objectives' => $objectives,
			'status' => $request->status,
			'lesson_date' => Carbon::now(),

		]);

		$lesson_id = $lesson->id;

		if($lesson->status=="publish"){
			foreach ($students as $student) {
				StudentLesson::create([
	
					'student_id' => $student,
					'lesson_id' => $lesson_id,
	
				]);
			}	
			flash()->overlay('Success. You have added a lesson', 'Add Lesson');

			return redirect('users/teacher/online-learning/manage');
		}else if($lesson->status=="draft"){
			flash()->overlay('<i class="fas fa-check-circle text-success"></i>  Success. Draft Added', 'Add Lesson Draft');

			return redirect('users/teacher/online-learning/manage');
		}

		


	
	}else{
		return view('errors.unauthorized');
		}
}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\OnlineLearning  $onlineLearning
	 * @return \Illuminate\Http\Response
	 */
	public function show(OnlineLearning $onlineLearning)

	//Shows a teachers lessons

	{

		if (Auth::user()->hasRole('teacher')) {

			$teacher_has_lessons = DB::table('lessons')
			->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
			->where('teaching_loads.teacher_id', Auth::user()->id)
			->select('teaching_loads.teacher_id')
			->exists();
			
			if(!$teacher_has_lessons){
				return view('errors.notfound');
			}else{

				//validations

					$lesson_teacher = DB::table('lessons')
					->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
					->where('teaching_loads.teacher_id', Auth::user()->id)
					->select('teaching_loads.teacher_id')
					->first();
					$teacher_lesson=$lesson_teacher->teacher_id;

					if($teacher_lesson==Auth::user()->id){

			$data = DB::table('lessons')
				->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
				->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
				->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
				->where('teaching_loads.teacher_id', Auth::user()->id)
				->select('lessons.id', 'grade_name', 'subject_name', 'lesson_content', 'lesson_title', 'lesson_date', 'status')
				->orderByDesc('id')
				->get();

			$id = $data[0]->id;

			$comments = DB::table('lesson_comments')
				->join('users', 'users.id', '=', 'lesson_comments.user_id')
				->where('lesson_comments.user_id', Auth::user()->id)
				->where('lesson_id', $id)
				->get();

			return view('online-learning.show', compact('data', 'comments'));
			}else{
				return view('errors.unauthorized');
			}
		}
		} else {
			return view('errors.unauthorized');
		}
	
	}
	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\OnlineLearning  $onlineLearning
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request)
	{
		//Updates a lesson

		if (Auth::user()->hasRole('teacher')) {
		$id = $request->id;

		$lesson_data = Lesson::find($id);
		$lesson_data->lesson_title = $request->lesson_title;
		$lesson_data->lesson_content = $request->lesson_content;
		$lesson_data->lesson_overview = $request->lesson_overview;
		$lesson_data->status = $request->status;
		$lesson_data->save();

		flash()->overlay('<i class="fas fa-check-circle mr-2 text-success "></i>Success. You have updated lesson', 'Update Lesson');

		return redirect()->back();
		}else{
			return view('errors.unauthorized');	
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\OnlineLearning  $onlineLearning
	 * @return \Illuminate\Http\Response
	 */
	public function update($id)
	{

		$AuthorizedTeacher=DB::table('lessons')
		->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
		->join('users', 'teaching_loads.teacher_id', '=', 'users.id')
		->select('users.id') 
		->where('lessons.id', $id)
		->first('id');


		//Actual manipulations of lessons
		if (Auth::user()->hasRole('teacher') AND $AuthorizedTeacher->id==Auth::user()->id) {

			$lesson = DB::table('lessons')
				->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
				->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
				->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
				->select('lesson_title','lesson_overview','lesson_objectives', 'lessons.id', 'lesson_content', 'lesson_date', 'subject_name', 'class_id', 'grade_name', 'teacher_id')
				->where('lessons.id', $id)
				->get();

			return view('online-learning.edit', compact('lesson'));
		} else {
			return view('errors.unauthorized');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\lesson  $lesson
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Lesson $lesson, $id)
	{
		DB::table('lessons')->where('id', $id)->delete();
		flash()->overlay('Success. You have deleted lesson', 'Delete Lesson');

		return redirect()->back();
	}
	public function students()
	{
		//Students

		if (Auth::user()->hasRole('student')) {
			$student_data = StudentLesson::where('student_id', Auth::user()->id)->get();
			$lesson = DB::table('student_lessons')
				->join('lessons', 'lessons.id', '=', 'student_lessons.lesson_id')
				->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
				->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
				->join('users', 'users.id', '=', 'teaching_loads.teacher_id')
				->where('student_lessons.student_id', Auth::user()->id)
				->orderBy('lessons.id', 'asc')
				->get();

			return view('online-learning.students', compact('lesson'));
		} else {
			return view('errors.unauthorized');
		}
	}

	public function create_assessement_teacher()
	{

		$lesson = DB::table('lessons')
			->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
			->select('lessons.id', 'lesson_title', 'lesson_content', 'lesson_date', 'lessons.created_at', 'teaching_load_id', 'teacher_id', 'subjects.subject_name', 'grades.grade_name')
			->where('teaching_loads.teacher_id', Auth::user()->id)

			->orderBy('lessons.id', 'asc')
			->get()->toArray();

				return view('online-learning.create-assessement', compact('lesson'));

		
	}


	public function quick_create_assessement_teacher(){
		//Create an assessement without lesson

		//First create assessement
		// Then attach questions

	}

	public function parent(){

		$parent=ParentStudent::where('parent_id', Auth::user()->id)->get();
		dd($parent->student_id);

		$parent_lesson = StudentLesson::where('student_id', Auth::user()->id)->get();
			$lesson = DB::table('student_lessons')
				->join('lessons', 'lessons.id', '=', 'student_lessons.lesson_id')
				->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
				->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
				->join('users', 'users.id', '=', 'teaching_loads.teacher_id')
				->where('student_lessons.student_id', Auth::user()->id)
				->orderBy('lessons.id', 'asc')
				->get();


	}

	public function show_assessement_teacher($id)
	{
		$lesson_id = $id;
		$lesson = DB::table('lessons')
			->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
			->select('lessons.id', 'lesson_title', 'lesson_content', 'lesson_date', 'lessons.created_at', 'teaching_load_id', 'teacher_id', 'subjects.subject_name', 'grades.grade_name', 'grades.id as class_id')
			->where('lessons.id', $id)
			->first();

		return view('online-learning.add-assessement', compact('lesson'));
	}
	public function store_assesement_teacher(Request $request)
	{


		dd($request->all());

		AssessementOnline::create([
			'teacher_id' => Auth::user()->id,
			'lesson_id' => $request->lesson_id,
			'title' => $request->title,
			'teaching_load_id' => $request->teaching_load_id,
			'content' => $request->lesson_content,
			'due_date' => $request->due_date,
		]);


		flash()->overlay('Success. You have added assessement', 'Add Assessement');

		return redirect('/online-learning/lessons/assessement/manage/');
	}

	public function manage_assesement_teacher()
	{

		$assessement_lesson = DB::table('assessement_onlines')
			->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
			->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
			->select('lessons.lesson_title', 'assessement_onlines.id', 'subject_name', 'due_date', 'grade_name', 'assessement_onlines.title')
			->where('assessement_onlines.teacher_id', Auth::user()->id)
			->get();

		return view('online-learning.manage-assessements', compact('assessement_lesson'));
	}

	public function show_assessement_student()
	{
		$assessement = DB::table('assessement_onlines')
		->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
		->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
		->join('student_loads', 'assessement_onlines.teaching_load_id', '=', 'student_loads.teaching_load_id')
		->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
		->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
		->select('assessement_onlines.*','student_loads.student_id',  'lessons.lesson_title', 'assessement_onlines.id', 'subject_name', 'due_date', 'grade_name')
		->where('student_loads.student_id', Auth::user()->id)
		->orderByDesc('id')
		->get();
		

	return view('online-learning.view-assessement-student', compact('assessement'));

	}

	public function assessement_feedback_student($id){

	$assessement = DB::table('assessement_onlines')
				->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
				->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
				->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
				->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
				->select('assessement_onlines.*', 'lessons.lesson_title', 'assessement_onlines.id', 'subject_name', 'due_date', 'grade_name')
				->where('assessement_onlines.id', $id)
				->get();
	return view('online-learning.add-assessement-feedback', compact('assessement'));
	}

	public function store_assessement_feedback_student(Request $request){
	
	
	$student_response=StudentResponse::create([
			'student_id'=>$request->student_id,
			'assessement_id'=>$request->assessement_id,
			'response'=>$request->feedback_content,

		]);

		flash()->overlay('Success. You have added your response', 'Add Assessement Response');

		return redirect('/users/students/online-learning/assessements');
		// return 'added';

	}

	public function view_student_assessements($id){
		
		//$students=StudentResponse::where('assessement_id', $id)->first();
		//dd()
		$students= DB::table('student_responses')
			->join('users', 'users.id', '=', 'student_responses.student_id')
			->select('users.name','users.lastname', 'users.middlename', 'users.id as student_id','student_responses.id as response_id', 'student_responses.created_at')
			->where('student_responses.assessement_id', $id)
			->get();

		
			

			//$assessement_mark=StudentResponse::where()

		$assessement= DB::table('assessement_onlines')
			->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')		
			->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
			->select('assessement_onlines.*','lessons.lesson_title', 'subject_name', 'due_date', 'grade_name', 'grades.id as class_id')
			->where('assessement_onlines.id', $id)
			->get();

			
			
	
		return view('online-learning.view-student-assessements', compact('students','assessement'));
		

	}

	public function create_student_result($id,$response_id, $student_id){
		
		$assessement_result=OnlineAssessementResult::where('student_id',$student_id)->first();
	//	$teacher=$assessement_result->teacher_id;

	//	if(Auth::user()->id==$teacher){
			$view_student_assessement=StudentResponse::where('id', $response_id)->first();
			$assessement= DB::table('assessement_onlines')
			->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')		
			->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
			->select('assessement_onlines.*','lessons.lesson_title', 'subject_name', 'due_date', 'grade_name', 'grades.id as class_id')
			->where('assessement_onlines.id', $id)
			->get();
			return view('online-learning.add-student-result', compact('assessement', 'view_student_assessement', 'assessement_result'));	
		//}else{
		//	return view('errors.unauthorized');
		//}


	}

	public function save_student_result(Request $request){

		OnlineAssessementResult::create([
			'student_id'=>$request->student_id,
			'teacher_id'=>$request->teacher_id,
			'assessement_id'=>$request->assessement_id,
			'mark'=>$request->mark,
			'comment'=>$request->comment,
		]);

		flash()->overlay('Success. You have added online assessement mark', 'Add Assessement Mark');

		return redirect('online-learning/lessons/assessement/teacher/feedback/'.$request->assessement_id);
	}

	public function edit_student_result(Request $request){

		$id=$request->result_id;

		$resultdata=OnlineAssessementResult::find($id);
		$resultdata->mark=$request->mark;
		$resultdata->comment=$request->comment;
		$resultdata->save();

		

		flash()->overlay('Success. You have updated online assessement mark', 'Update Assessement Mark');

		return Redirect::back();
	}
	

	public function edit_assessement($id)
	{

		$assessement = DB::table('assessement_onlines')
			->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
			->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')

			->select('assessement_onlines.*', 'lessons.lesson_title', 'subject_name', 'due_date', 'grade_name', 'grades.id as class_id')
			->where('assessement_onlines.id', $id)
			->get();

		return view('online-learning.edit-assessement', compact('assessement'));
	}

	public function update_assessement(Request $request)
	{

		$id = $request->id;
		$assessement_data = AssessementOnline::find($id);
		$assessement_data->due_date = $request->due_date;
		$assessement_data->content = $request->content;
		$assessement_data->save();

		flash()->overlay('Success. You have updated assessement', 'Update Assessement');
		return redirect()->back();
	}

	public function delete_assessement($id)
	{

		DB::table('assessement_onlines')->where('id', $id)->delete();
		flash()->overlay('Success. You have deleted  assessement', 'Delete Assessement');

		return redirect()->back();
	}

	public function view_assessement($id)
	{

		$assessement = DB::table('assessement_onlines')
			->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
			->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
			->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
			->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
			->select('assessement_onlines.*', 'lessons.lesson_title', 'assessement_onlines.id', 'subject_name', 'due_date', 'grade_name')
			->where('assessement_onlines.id', $id)
			->get();

		return view('online-learning.view-assessement', compact('assessement'));
	}

	public function view_assessement_result($id,$assessement){
		
		if(Auth::user()->id==$id){

		$results = DB::table('student_responses')
		->join('users', 'users.id', '=', 'student_responses.student_id')
		->join('online_assessement_results', 'online_assessement_results.student_id', '=', 'student_responses.student_id')
		->join('assessement_onlines', 'assessement_onlines.id', '=', 'student_responses.assessement_id')
		->select('online_assessement_results.id as result_id','users.id as user_id', 'name', 'lastname', 'middlename', 'profile_photo_path', 'response', 'mark', 'comment', 'assessement_onlines.id as assessement_id')
		->where('student_responses.student_id', $id)
		->where('users.id', $id)
		->where('online_assessement_results.id',$assessement )
		->get();

		dd($results);
	

		$result_id=$results[0]->result_id;

		$teacher = DB::table('online_assessement_results')
		->join('users', 'users.id', '=', 'online_assessement_results.teacher_id')
		->select('users.id as user_id', 'name','lastname','salutation', 'lastname', 'middlename', 'profile_photo_path',  'online_assessement_results.created_at as created_at')
		->where('online_assessement_results.id', $result_id)
		->get();

	return view('online-learning.student-view-results', compact('results', 'teacher'));
		}else{
			$message="Sorry Unauthorized";
			return view('errors.unauthorized', compact('message'));
		}
		
}
	}
