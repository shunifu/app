<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Models\Acl;
use App\Models\Term;
use App\Models\PassRate;
use App\Models\VirtualClass;
use App\Models\LessonComment;
use App\Models\OnlineLearning;
use App\Http\Controllers\Passwo;
use TCG\Voyager\Facades\Voyager;
use App\Models\AssessementWeight;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ModalManagement;
use App\Http\Middleware\CheckPassword;
use App\Http\Controllers\AclController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\TermController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CAExamController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PassRateController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorToolController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\SchoolFeeController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MarkSymbolController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\ResolutionController;
use App\Http\Controllers\TransitionController;
use App\Http\Controllers\AssessementController;
use App\Http\Controllers\PartnerTypeController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\RatioCheckerController;
use App\Http\Controllers\TeachingLoadController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VirtualClassController;
use App\Http\Controllers\ClassSequenceController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\LessonCommentController;
use App\Http\Controllers\CommentSettingController;
use App\Http\Controllers\OnlineLearningController;
use App\Http\Controllers\ReportTemplateController;
use App\Http\Controllers\VirtualMeetingController;
use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\AssessementTypeController;
use App\Http\Controllers\OneTimePasswordController;
use App\Http\Controllers\RolesManagementController;
use App\Http\Controllers\AssessementWeightController;
use App\Http\Controllers\ProgressionStatusController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\AssessementSettingController;
use App\Http\Controllers\CoronaSurvellianceController;
use App\Http\Controllers\AssessementQuestionController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\PermissionsManagementController;
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/reset', function () {
    return view('auth.forgot-password');
});

Route::post('/password/reset', [OneTimePasswordController::class,'sendOTP']);

// 
Route::post('/update-password',  [PasswordController::class,'change'])->name('password.change');

    Route::group(['middleware' => ['auth', 'CheckPassword']], function() {
    Route::get('/dashboard' ,'App\Http\Controllers\DashboardController@index')->name('dashboard');

   

    //Secton Routes
Route::get('/academic-admin/section', [SectionController::class,'index'])->name('section.index');
Route::post('/academic-admin/section/add', [SectionController::class,'store'])->name('section.store');
Route::get('/academic-admin/section/edit/{section}', [StreamController::class,'edit'])->name('stream.edit');
Route::get('/academic-admin/section/delete/{section}', [StreamController::class,'destroy'])->name('section.destroy');

//Stream Routes
Route::get('/academic-admin/stream', [StreamController::class,'create'])->name('stream.create');
Route::post('/academic-admin/stream/add', [StreamController::class,'store'])->name('stream.store');
Route::get('/academic-admin/stream/edit/{id}', [StreamController::class,'edit'])->name('stream.edit');
Route::patch('/academic-admin/update', [StreamController::class,'update'])->name('stream.update');

Route::get('/academic-admin/stream/delete/{stream}', [StreamController::class,'destroy'])->name('stream.destroy');

//Class Routes
Route::get('/academic-admin/class', [GradeController::class,'index'])->name('grade.index');
Route::get('/academic-admin/class/view/{id}', [GradeController::class,'show'])->name('grade.show');
Route::get('/academic-admin/class/pdf/{id}', [GradeController::class, 'createPDF']);
Route::post('/academic-admin/class/add', [GradeController::class,'store'])->name('grade.store');
Route::get('/academic-admin/class/edit/{id}', [GradeController::class,'edit'])->name('grade.edit');
Route::post('/academic-admin/class/update', [GradeController::class,'update'])->name('grade.update');
Route::get('/academic-admin/class/delete/{section}', [GradeController::class,'destroy'])->name('grade.destroy');

//Subject Routes
Route::get('/academic-admin/subject', [SubjectController::class,'create'])->name('subject.create');
Route::post('/academic-admin/subject/add', [SubjectController::class,'store'])->name('subject.store');
Route::get('/academic-admin/subject/edit/{id}', [SubjectController::class,'edit'])->name('subject.edit');
Route::post('/academic-admin/subject/update/', [SubjectController::class,'update'])->name('subject.update');
Route::get('/academic-admin/subject/delete/{id}', [SubjectController::class,'destroy'])->name('subject.destroy');

//Department Routes
Route::get('/academic-admin/department', [DepartmentController::class,'create'])->name('department.create');
Route::get('/academic-admin/department/teacher', [DepartmentController::class,'add_teacher'])->name('department.teacher');
Route::post('/academic-admin/department/add', [DepartmentController::class,'store'])->name('department.store');
Route::get('/academic-admin/department/edit/{department}/{id}', [DepartmentController::class,'edit'])->name('department.edit');
Route::get('/academic-admin/department/update/', [DepartmentController::class,'update'])->name('department.update');
Route::get('/academic-admin/department/delete/{department}/{id}', [DepartmentController::class,'destroy'])->name('department.destroy');

Route::get('/users/student/class/get/students/{id} ', [StudentController::class,'search'])->name('students.search');
Route::get('/students/transfer/',[StudentController::class,'transfer'])->name('students.transfer');
Route::post('/students/transfer/load',[StudentController::class,'get_students'])->name('students.gets_students');
Route::get('/students/transfer/process/',[StudentController::class,'transfer_students'])->name('students.transfer_students');

Route::post('/student/import/',  [StudentController::class,'import'])->name('student.import');

//School Routes
Route::get('/academic-admin/school', [SchoolController::class,'create'])->name('school.create');
Route::post('/academic-admin/school/add', [SchoolController::class,'store'])->name('school.store');
Route::post('/academic-admin/school/edit/', [SchoolController::class,'edit'])->name('school.edit');
Route::get('/academic-admin/school/delete/{id}', [SchoolController::class,'destroy'])->name('school.destroy');

//Academic Session Routes
Route::get('/academic-admin/session', [AcademicSessionController::class,'create'])->name('session.create');
Route::post('/academic-admin/session/add', [AcademicSessionController::class,'store'])->name('session.store');
Route::get('/academic-admin/session/edit/{id}', [AcademicSessionController::class,'edit'])->name('session.edit');
Route::post('/academic-admin/session/update', [AcademicSessionController::class,'update'])->name('session.update');
Route::get('/academic-admin/session/delete/{id}', [AcademicSessionController::class,'destroy'])->name('sesson.destroy');

Route::get('view/terms/{id}', [TermController::class,'index'])->name('term.index');
Route::post('terms/add/', [TermController::class,'store'])->name('term.store');
Route::post('terms/edit/', [TermController::class,'edit'])->name('term.edit');
Route::patch('terms/update', [TermController::class,'update'])->name('term.update');
Route::delete('/terms/delete/', [TermController::class,'destroy'])->name('term.destroy');

//Terms
// Route::get('/academic-admin/terms', [ShunifuTermController::class,'create'])->name('term.create');
// Route::post('/academic-admin/terms/add', [ShunifuTermController::class,'store'])->name('term.store');
Route::get('/academic-admin/session/edit/{id}', [AcademicSessionController::class,'edit'])->name('term.edit');
Route::get('/academic-admin/session/delete/{id}', [AcademicSessionController::class,'destroy'])->name('term.destroy');




//End of terms

Route::get('/academic-admin/resolution-management/index', [ResolutionController::class,'index'])->name('resolutions.index');

Route::post('/academic-admin/resolution-management/view', [ResolutionController::class,'load'])->name('resolutions.load');


//Roles Management
Route::get('/roles/', [RolesManagementController::class,'create'])->name('roles.index');
Route::post('/roles/add', [RolesManagementController::class,'store'])->name('roles.store');
//Route::pac('/roles/', [RolesManagementController::class,'index'])->name('roles.index');
//End of Roles Management


//Permissions Management
Route::get('/permissions/', [PermissionsManagementController::class,'create'])->name('permissions.index');
Route::post('/permissions/add', [PermissionsManagementController::class,'store'])->name('permissions.store');

//End of Permissions Management


//Lesson Plan Management //




//End of Lesson Plan //


Route::get('/get/stream/{stream_id}', [SchoolFeeController::class,'getStream'])->name('stream.get');



//Student Data Route
Route::get('/users/student', [StudentController::class,'create'])->name('student.create');
Route::post('/users/student/manage/load', [StudentController::class,'load'])->name('student.load');
Route::post('/users/student/manage/list', [StudentController::class,'list'])->name('student.list');
Route::get('/users/student/management', [StudentController::class,'students_management'])->name('students.management');
Route::get('/users/student/images', [StudentController::class,'student_images_index'])->name('student.images');
Route::post('/users/student/images/save', [StudentController::class,'student_images_store'])->name('student.image_store');
Route::get('/users/student/get/list', [StudentController::class,'get_list'])->name('student.get_list');
Route::get('/students/manage', [StudentController::class,'manage'])->name('student.manage');
Route::get('/students/manage/stream/{stream_id}', [StudentController::class,'student_stream'])->name('student.student_stream');
Route::post('/students/management/search/', [StudentController::class,'student_search'])->name('student.student_search');
Route::post('/students/management/search/class', [StudentController::class,'class_search'])->name('student.class_search');

Route::get('/templates/spreadsheet/student-registration', [StudentController::class,'template_export'])->name('student.template');
// Student-Registration-Pathway

Route::get('/registration/student/pathway/single', [StudentController::class,'single_pathway_index'])->name('pathway.single_index');
Route::post('/registration/student/pathway/single/store', [StudentController::class,'single_pathway_store'])->name('pathway.single_store');

Route::get('/registration/student/pathway/bulk', [StudentController::class,'bulk_pathway_index'])->name('pathway.bulk_index');
Route::post('/registration/student/pathway/bulk/store', [StudentController::class,'bulk_pathway_store'])->name('pathway.bulk_store');
// End of Student-Registration Pathway

Route::get('/students/management/stream/{id}', [StudentController::class,'student_management_stream'])->name('student.student_management_stream');

Route::post('/users/student/add', [StudentController::class,'store'])->name('student.store');
Route::post('/users/student/add/bulk', [StudentController::class,'bulk'])->name('student.bulk');

Route::post('/users/student/edit/', [StudentController::class,'update'])->name('student.update');
Route::post('/users/student/parent/add', [StudentController::class,'parent_update'])->name('student.parent_update');
Route::get('/users/student/show/{id}',  [StudentController::class,'show'])->name('student.show');
Route::get('/users/profile/student/{id}',  [StudentController::class,'profile'])->name('student.profile');
Route::get('/users/student/delete/{id}', [StudentController::class,'destroy'])->name('student.destroy');
Route::get('users/student/manage/password/reset/{id}',[StudentController::class,'password_reset'])->name('student.password_reset');
Route::get('users/student/manage/removal/',[StudentController::class,'student_removal'])->name('student.removal_index');
Route::get('/class/student-management',[StudentController::class,'student_issues_classteacher'])->name('student.student_issues_classteacher');



Route::post('users/student/manage/removal/process',[StudentController::class,'removal_loadstudents'])->name('student.removal');
Route::post('users/student/manage/removal/process/selection',[StudentController::class,'removal'])->name('student.removal_selection');

Route::post('student/image/upload',[StudentController::class,'student_image'])->name('student.image');

//Route::post('/users/student/search/list/{search}/', [StudentController::class,'student_search'])->name('student.student_search');

Route::get('/student/my-subjects', [StudentController::class,'my_subjects'])->name('student.subjects');
//Parent Link


Route::get('/link/students-parents/',  [StudentController::class,'parent_link'])->name('parent_link.index');
Route::get('/class/student-management/link-parents',  [StudentController::class,'parent_link_class_teacher'])->name('parent_link.index_class_teacher');
Route::post('/link/students-parents/list',  [StudentController::class,'parent_link_show'])->name('parent_link.show');
Route::post('/link/students-parents/form',  [StudentController::class,'parent_link_store'])->name('parent_link.store');

//Teacher Data Route
Route::get('/users/teacher', [TeacherController::class,'create'])->name('teacher.create');
Route::get('/users/teachers/manage', [TeacherController::class,'view'])->name('teacher.manage');

Route::post('/teacher/import/',  [TeacherController::class,'import'])->name('teacher.import');
Route::get('/teacher/login/{id}',  [TeacherController::class,'login'])->name('teacher.login');
Route::get('/undo/deactivation/{id}',  [TeacherController::class,'undo'])->name('teacher.undo');

//
// Route::get('/teacher/view/{{Crypt::encryptString(Auth::user()->id)}}',  [TeacherController::class,'undo'])->name('teacher.undo');
// /teacher/view/{{Crypt::encryptString(Auth::user()->id)}}


//Class Sequence

Route::get('/class-sequencing/', [ClassSequenceController::class,'index'])->name('sequence.index');
Route::get('/class-sequencing/create', [ClassSequenceController::class,'create'])->name('sequence.create');

Route::post('/class-sequencing/add', [ClassSequenceController::class,'store'])->name('sequence.store');
Route::get('/class-sequencing/delete/{id}', [ClassSequenceController::class,'destroy'])->name('sequence.destroy');


//end of class_sequence


//Migration Management

Route::get('/migration/', [TransitionController::class,'index'])->name('transition.index');
Route::post('/migration/process', [TransitionController::class,'process'])->name('transition.process');
Route::post('/migration/store', [TransitionController::class,'store'])->name('transition.store');
Route::get('/session-management/migration/class-type', [TransitionController::class,'class_type'])->name('transition.class_type');
Route::get('/next/class/{id}', [TransitionController::class,'next_class'])->name('transition.next_class');


//End of Migration Management


//Testimonial


Route::get('/testimonial/create', [TransitionController::class,'index'])->name('testimonial.index');
//

//Class Teacher Management//

Route::get('/class/class-list', [TeacherController::class,'class_list'])->name('class_teacher.class_list');

//End of Class Teacher Management

Route::get('/users/teacher/assign/classteacher', [TeacherController::class,'class_teacher'])->name('teacher.class_teacher');
Route::post('/users/teacher/assign/assign_classteacher', [TeacherController::class,'assign_classteacher'])->name('teacher.assign_classteacher');
Route::post('/users/teacher/add', [TeacherController::class,'store'])->name('teacher.store');
Route::post('/users/teacher/add/bulk', [TeacherController::class,'bulk'])->name('teacher.bulk');
Route::post('/users/teacher/edit', [TeacherController::class,'edit'])->name('teacher.edit');
Route::get('/teacher/archive/{id}', [TeacherController::class,'archive'])->name('teacher.destroy');
Route::get('/teacher/reactivate/{id}', [TeacherController::class,'reactivate'])->name('teacher.reactivate');
Route::get('/users/classteacher/edit/{id}', [TeacherController::class,'classteacher_edit'])->name('classteacher.edit');
Route::delete('/users/class-teacher/delete/{id}', [TeacherController::class,'classteacher_delete'])->name('classteacher.delete');

Route::get('/teacher/reset/{id}',[TeacherController::class,'reset'])->name('teacher.reset');

//Teaching Loads
Route::get('/users/teacher/loads', [TeachingLoadController::class,'create'])->name('teacher.teaching_loads');
Route::post('/users/teacher/loads/add', [TeachingLoadController::class,'loadstudents'])->name('teacher.loadstudents');
Route::post('/users/teacher/loads/save', [TeachingLoadController::class,'store'])->name('teachingloads.store');
Route::get('/users/teacher/loads/manage', [TeachingLoadController::class,'show'])->name('teaching_loads.show');
Route::post('/get/load', [TeachingLoadController::class,'get_load']);
Route::patch('/loads/update',[TeachingLoadController::class,'loads_update']);

Route::get('/teaching-loads/transfer', [TeachingLoadController::class,'transfer_loads_index'])->name('teaching_loads_transfer.load_students');
Route::post('/teaching-loads/transfer/load/step/2', [TeachingLoadController::class,'transfer_loads_step2'])->name('teaching_loads_transfer.step2');
Route::post('/teaching-loads/transfer/load/step/3', [TeachingLoadController::class,'transfer_loads_step2_some'])->name('teaching_loads_transfer.step3');

Route::get('/users/teacher/loads/view/{id}', [TeachingLoadController::class,'view'])->name('teaching_loads.view');
Route::get('/users/teacher/loads/update/{id}', [TeachingLoadController::class,'update'])->name('teaching_loads.update');
Route::get('/users/teacher/loads/delete/{id}', [TeachingLoadController::class,'destroy'])->name('teaching_loads.destroy');
Route::get('/users/teacher/loads/student/delete/{id}/{student}', [TeachingLoadController::class,'student_destroy'])->name('teaching_loads.student_destroy');

Route::post('/teaching-loads/archive', [TeachingLoadController::class,'archive'])->name('teaching_loads.archive');
Route::post('/teaching-loads/delete', [TeachingLoadController::class,'delete'])->name('teaching_loads.delete');

//Support Staff Data Route
Route::get('/users/support', [AdminStaffController::class,'create'])->name('support.create');
Route::post('/users/support/add', [AdminStaffController::class,'store'])->name('support.store');
Route::post('/users/support/add/bulk', [AdminStaffController::class,'bulk'])->name('support.bulk');
Route::get('/users/support/edit/{id}', [AdminStaffController::class,'edit'])->name('support.edit');
Route::get('/users/support/delete/{id}', [AdminStaffController::class,'destroy'])->name('support.destroy');


//Online Learning Routes
Route::get('/users/teacher/online-learning', [OnlineLearningController::class,'create'])->name('online-learning.create');
Route::get('/online/permissions', [AclController::class,'elearning']);
Route::get('/users/teacher/online-learning/view/{id}', [OnlineLearningController::class,'index'])->name('online-learning.view');
Route::get('/users/student/online-learning/view/{id}', [OnlineLearningController::class,'student_view'])->name('online-learning.student_view');

Route::post('/users/lesson/online-learning/comments/add', [LessonCommentController::class,'store'])->name('lesson-comments.store');

Route::get('/online-learning/assessement/create/', [OnlineLearningController::class,'create_assessement_teacher'])->name('online-learning.create_assessement_teacher');

Route::get('/online-learning/lessons/assessement/add/{id}', [OnlineLearningController::class,'show_assessement_teacher'])->name('online-learning.show_assessement_teacher');

Route::post('/online-learning/lessons/assessement/store/', [OnlineLearningController::class,'store_assesement_teacher'])->name('online-learning.store_assesement_teacher');

Route::get('/online-learning/lessons/assessement/manage/', [OnlineLearningController::class,'manage_assesement_teacher'])->name('online-learning.manage_assesement_teacher');

Route::get('/online-learning/lessons/assessement/view/{id}',[OnlineLearningController::class, 'view_assessement'])->name('online-learning.view_assessement');

Route::get('/online-learning/lessons/assessement/edit/{id}',[OnlineLearningController::class, 'edit_assessement'])->name('online-learning.edit_assessement');

Route::post('/online-learning/lessons/assessement/update/',[OnlineLearningController::class, 'update_assessement'])->name('online-learning.update_assessement');

Route::get('/online-learning/lessons/assessement/delete/{id}',[OnlineLearningController::class, 'delete_assessement'])->name('online-learning.delete_assessement');


Route::get('/online-learning/assessement/assesement_feedback/', [OnlineLearningController::class,'assesement_feedback'])->name('online-learning.assesement_feedback');

Route::post('/users/lesson/online-learning/comments/add', [LessonCommentController::class,'store'])->name('lesson-comments.store')->middleware('auth');

Route::post('/users/teacher/online-learning/add', [OnlineLearningController::class,'store'])->name('online-learning.store');
Route::get('/users/teacher/online-learning/zoom', [OnlineLearningController::class,'zoom'])->name('online-learning.zoom');
Route::get('/users/teacher/online-learning/zoom/add', [OnlineLearningController::class,'zoom_store'])->name('online-learning.zoom_store');
Route::get('/users/teacher/online-learning/manage', [OnlineLearningController::class,'show'])->name('online-learning.manage')->middleware('auth');
Route::post('/users/student/online-learning', [OnlineLearning::class,'student_create'])->name('online-learning.student_create')->middleware('auth');
Route::get('/users/students/online-learning/', [OnlineLearningController::class,'students'])->name('online-learning.students')->middleware('auth');

Route::get('/users/parents/online-learning/', [OnlineLearningController::class,'parents'])->name('online-learning.parents')->middleware('auth');

Route::get('/online-learning/lessons/assessement/feedback/results/{id}/{assessement}', [OnlineLearningController::class,'view_assessement_result'])->name('online-learning.view_assessement_results')->middleware('auth');

Route::get('/users/students/online-learning/feedback', [OnlineLearningController::class,'feedback_student_send'])->name('online-learning.student_feedback_send')->middleware('auth');

Route::get('/users/students/online-learning/feedback', [OnlineLearningController::class,'feedback_student_send'])->name('online-learning.student_feedback_send')->middleware('auth');

Route::get('/users/students/online-learning/assessements', [OnlineLearningController::class,'show_assessement_student'])->name('online-learning.view-assessement');

Route::post('/users/teacher/online-learning/edit/', [OnlineLearningController::class,'edit'])->name('online-learning.edit');

Route::get('online-learning/lessons/assessement/feedback/{id}', [OnlineLearningController::class,'assessement_feedback_student'])->name('online-learning.assessement_feedback_student');
Route::post('online-learning/lessons/assessement/feedback/add', [OnlineLearningController::class,'store_assessement_feedback_student'])->name('online-learning.store_assessement_feedback_student');

Route::get('online-learning/lessons/assessement/teacher/feedback/{id}', [OnlineLearningController::class,'view_student_assessements'])->name('online-learning.view_student_assessements');

Route::get('online-learning/lessons/assessement/teacher/feedback/add/{id}/{response_id}/{student_id}', [OnlineLearningController::class,'create_student_result'])->name('online-learning.create_student_result');

Route::post('online-learning/lessons/assessement/teacher/feedback/save', [OnlineLearningController::class,'save_student_result'])->name('online-learning.save_student_result');

Route::post('online-learning/lessons/assessement/teacher/feedback/edit', [OnlineLearningController::class,'edit_student_result'])->name('online-learning.edit_student_result');

Route::post('online-learning/lessons/comment/', [OnlineLearningController::class,'edit_student_result'])->name('online-learning.edit_comment');

Route::get('/users/teacher/online-learning/update/{id}', [OnlineLearningController::class,'update'])->name('online-learning.update');

Route::get('/users/teacher/online-learning/destroy/{id}', [OnlineLearningController::class,'destroy'])->name('online-learning.destroy');

Route::get('/online-learning/assessement/create/without-lesson/', [AssessementQuestionController::class,'index_without_lesson'])->name('online-learning.create_assessement_without_lesson');


Route::get('/online-learning/assessement/create/without-lesson/save', [AssessementQuestionController::class,'store'])->name('online-learning.assessement_store');

Route::get('getSubject',[AssessementQuestionController::class, 'getSubject'])->name('getSubject');

Route::get('/online-learning/assessement/create/assessement/', [AssessementQuestionController::class,'index'])->name('online-learning.create_assessement');

Route::get('/online-learning/assessements/attach-questions/{id}',[AssessementQuestionController::class, 'attach_questions'])->name('online-learning.attach_questions');

Route::post('/online-learning/assessements/attach-questions/save',[AssessementQuestionController::class, 'attach_questions_store'])->name('online-learning.attach_questions_store');

Route::post('/online-learning/assessement/save/',[AssessementQuestionController::class, 'assessement_store']);

Route::get('/online-learning/assessements/question/delete/{id}',[AssessementQuestionController::class, 'delete_question'])->name('online-learning.delete_question');

Route::get('/online-learning/assessements/delete/{id}',[AssessementQuestionController::class, 'delete_assessement'])->name('online-learning.delete_assessement');

Route::get('/online-learning/assessements/view/edit/{id}',[AssessementQuestionController::class, 'view_assessement'])->name('online-learning.view_assessement');

Route::post('/online-learning/assessements/update',[AssessementQuestionController::class, 'update_assessement'])->name('online-learning.update_assessement');

Route::get('/online-learning/virtual-class',[OnlineLearningController::class, 'virtual_class'])->name('online-learning.virtual_class');

Route::post('/users/support/add/bulk', [AdminStaffController::class,'bulk'])->name('support.bulk');
Route::get('/users/support/edit/{id}', [AdminStaffController::class,'edit'])->name('support.edit');
Route::get('/users/support/delete/{id}', [AdminStaffController::class,'destroy'])->name('support.destroy');

Route::get('/topics/', [TopicController::class,'create'])->name('topics.create');
Route::post('/topics/save/', [TopicController::class,'store'])->name('topics.store');
Route::get('/topics/delete/{id}', [TopicController::class,'destroy'])->name('topics.destroy');
Route::get('/get/topics/{id}', [TopicController::class,'get_topics'])->name('topics.get_topics');

// Route::get('/show-pdf/{id}', function($id) {
//     $file = LessonCommentController::find($id);
//     return response()->file(storage_path($file->path));
// })->name('show-pdf');




//School Accounting

//Accounts Management
Route::get('/accounting/fees-management/accounts/add',[AccountController::class,'create'])->name('accounts.create');
Route::get('/accounting/fees-management/accounts/account/edit/{id}',[AccountController::class,'edit'])->name('accounts.edit');
Route::get('/accounting/fees-management/accounts/account/update/',[AccountController::class,'update'])->name('accounts.update');
Route::post('/accounting/fees-management/accounts/store',[AccountController::class,'store'])->name('accounts.store');
Route::get('accounting/fees-management/accounts/account/delete/{id}',[AccountController::class,'destroy'])->name('accounts.destroy');

Route::get('/accounting/fees-management/fee-structure',[SchoolFeeController::class,'index'])->name('fee_structure.index');
Route::post('/accounting/fees-management/fee-structure/add',[SchoolFeeController::class,'create'])->name('fee_structure.create');

Route::post('/add/fee-structure',[SchoolFeeController::class,'store'])->name('fee_structure.store');


Route::get('/get/student/payment/{id}/{grade_id}',[StudentController::class,'getPayment']);

Route::post('/add/student/payments',[StudentController::class,'makePayment']);

Route::post('/add/student/payments/test',[StudentController::class,'makePayment_test']);



//Partner Type Management
Route::get('/accounting/partners/type/add',[PartnerTypeController::class,'create'])->name('partner_type.create');
Route::get('/accounting/partners/type/edit/{id}',[PartnerTypeController::class,'edit'])->name('partner_type.edit');
Route::post('/accounting/partners/type/save/',[PartnerTypeController::class,'store'])->name('partner_type.store');
Route::get('/accounting/partners/type/delete/{id}',[PartnerTypeController::class,'destroy'])->name('partner_type.destroy');

//Partner  Management
Route::get('/accounting/partners/add',[PartnerController::class,'create'])->name('partner.create');
Route::get('/accounting/partners/edit/{id}',[PartnerController::class,'edit'])->name('partner.edit');
Route::post('/accounting/partners/save/',[PartnerController::class,'store'])->name('partner.store');
Route::get('/accounting/partners/delete/{id}',[PartnerController::class,'destroy'])->name('partner.destroy');

//Petty Cash  Management
Route::get('/accounting/pettycash/add',[PettyCashController::class,'create'])->name('pettycash.create');
Route::get('/accounting/pettycash/view/',[PettyCashController::class,'index'])->name('pettycash.index');
Route::get('/accounting/petty-cash/report/',[PettyCashController::class,'report_index'])->name('pettycash.report_index');
Route::post('/accounting/petty-cash/report/',[PettyCashController::class,'report'])->name('pettycash.report');

Route::get('/accounting/pettycash/view/{id}',[PettyCashController::class,'view'])->name('pettycash.view');
Route::get('/accounting/pettycash/edit/{id}',[PettyCashController::class,'edit'])->name('pettycash.edit');
Route::post('/accounting/pettycash/save/',[PettyCashController::class,'store'])->name('pettycash.store');
Route::get('/accounting/pettycash/delete/{id}',[PettyCashController::class,'destroy'])->name('pettycash.destroy');

Route::get('/accounting/fees',[FeesController::class,'index'])->name('fees.index');
Route::get('/accounting/fees/add',[FeesController::class,'store'])->name('fees.store');
Route::post('/accounting/fees/edit',[FeesController::class,'store'])->name('pettycash.store');
Route::get('/accounting/pettycash/delete/{id}',[FeesController::class,'destroy'])->name('pettycash.destroy');

//end of school accounting



//
//Assessement Settings
Route::get('/settings/assessement/',[AssessementSettingController::class,'index'])->name('assessement_settings.index');

Route::post('/settings/assessements/type/add',[AssessementTypeController::class,'store'])->name('assessement-type.store');
Route::get('/assessement/type/edit/{id}',[AssessementTypeController::class,'edit'])->name('assessement-type.edit');
Route::put('/settings/assessements/type/update',[AssessementTypeController::class,'update'])->name('assessement-type.update');

Route::get('/assessement/type/delete/{id}',[AssessementTypeController::class,'destroy'])->name('assessement-type.destroy');


//Manage Assessement
Route::post('/settings/assessements/assessement/add',[AssessementController::class,'store'])->name('assessement.store');
Route::delete('/assessements/assessement/delete/{id}',[AssessementController::class,'destroy'])->name('assessement.destroy');
Route::get('/assessements/assessement/edit/{id}',[AssessementController::class,'edit'])->name('assessement.edit');
Route::get('/assessements/assessement/update/{id}',[AssessementController::class,'update'])->name('assessement.update');

//End of Assessement Management

//Manage CA Exam
Route::post('/settings/assessements/ca_exam/add',[CAExamController::class,'store'])->name('CA_Exam.store');
Route::put('/settings/assessements/ca_exam/update',[CAExamController::class,'update'])->name('CA_Exam.update');
Route::get('/assessements/ca_exam/edit/{id}',[CAExamController::class,'edit'])->name('CA_Exam.edit');
Route::get('/assessements/ca_exam/delete/{id}',[CAExamController::class,'destroy'])->name('CA_Exam.destroy');

//End of CA Exam

//Manage Assessement Weight
Route::post('/settings/assessements/assessement-weight/add',[AssessementWeightController::class,'store'])->name('assessement_weight.store');
Route::get('/assessements/assessement-weight/edit/{id}',[AssessementWeightController::class,'edit'])->name('assessement-weight.edit');
Route::get('/assessements/assessement-weight/delete/{id}',[AssessementWeightController::class,'destroy'])->name('assessement_weight.destroy');
Route::post('/assessement/weight/update/',[AssessementWeightController::class,'update'])->name('assessement-weight.update');

//End of Assessement Settings


//Manage Pass rates Weight
Route::post('/settings/assessements/pass-rates/add',[PassRateController::class,'store'])->name('pass-rates.store');
Route::get('/assessements/pass-rates/delete/{id}',[PassRateController::class,'destroy'])->name('pass-rates.destroy');
Route::get('/assessements/pass-rates/edit/{id}',[PassRateController::class,'edit'])->name('pass-rates.edit');
Route::post('/assessements/pass-rates/update',[PassRateController::class,'update'])->name('pass-rates.update');

// Route::get('/assessements/pass-rates/update/',[PassRateController::class,'edit'])->name('pass-rates.edit');
//End of Assessement Settings

//Marks Management
Route::get('/marks',[MarkController::class,'create'])->name('marks.create');
Route::post('/marks/students/show',[MarkController::class,'show'])->name('marks.show');
Route::post('/marks/save',[MarkController::class,'store'])->name('marks.store');
Route::get('/marks/manage',[MarkController::class,'manage'])->name('marks.manage');
Route::post('/marks/show',[MarkController::class,'show_marks'])->name('marks.show_marks');
Route::get('/marks/transfer',[MarkController::class,'transfer_marks'])->name('marks.transfer');
Route::post('/marks/transfering',[MarkController::class,'transfering'])->name('marks.transfering');
Route::delete('/marks/delete',[MarkController::class,'destroy'])->name('marks.destroy');
Route::get('/marks/edit/{id}',[MarkController::class,'edit'])->name('marks.edit');
Route::patch('/marks/update',[MarkController::class,'update'])->name('marks.update');



Route::get('/marks/analytics',[MarkController::class,'analysis'])->name('marks.analysis');
Route::post('/marks/analytics/show',[MarkController::class,'analysis_store'])->name('marks.analysis_store');

Route::get('/marks/check/',[MarkController::class,'check_marks'])->name('marks.check');
Route::post('/marks/check/form',[MarkController::class,'marks_check_search'])->name('marks.check_search_form');

Route::get('/checker/ratio/index',[RatioCheckerController::class,'index'])->name('ratio_checker.index');
Route::post('/checker/ratio/show',[RatioCheckerController::class,'show'])->name('ratio_checker.show');
Route::post('/checker/ratio/process',[RatioCheckerController::class,'process'])->name('ratio_checker.process');
//End of Marks Management


//Checks
Route::get('/check/loads/',[CheckController::class,'check_loads_index'])->name('check.loads');
Route::get('admin/check/loads/',[CheckController::class,'admin_check_loads_index'])->name('admin_check.loads');

Route::post('/check/loads/process',[CheckController::class,'check_loads_process'])->name('check_loads_process');
Route::post('admin/check/loads/process',[CheckController::class,'admin_check_loads_process'])->name('admin_check_loads_process');

Route::get('/check/loads/view/{id}', [CheckController::class,'view_students'])->name('teaching_loads.view-checker');
Route::post('/check/marks/',[CheckController::class,'check_marks'])->name('check.marks');



//end of checks


//Beginning of Timetable
//Assessement Settings
Route::get('/timetable/',[TimeTableController::class,'index'])->name('timetable.index');
Route::get('/timetable/show',[TimeTableController::class,'show'])->name('timetable.show');

Route::post('/settings/assessements/type/add',[AssessementTypeController::class,'store'])->name('assessement-type.store');
Route::get('/assessement/type/edit/{id}',[AssessementTypeController::class,'edit'])->name('assessement-type.edit');
Route::put('/settings/assessements/type/update',[AssessementTypeController::class,'update'])->name('assessement-type.update');

Route::get('/assessement/type/delete/{id}',[AssessementTypeController::class,'destroy'])->name('assessement-type.destroy');

//end of timetable

//Parent Data Route
Route::get('/users/parent', [ParentController::class,'create'])->name('parents.create');
Route::get('/users/parents/manage', [ParentController::class,'manage'])->name('parents.manage');
Route::post('/users/parents/save', [ParentController::class,'store'])->name('parents.store');
Route::get('/parent/view/{id}',  [ParentController::class,'show'])->name('parent.show');
Route::post('/parent/edit/',  [ParentController::class,'edit'])->name('parent.edit');
Route::post('/parent/import/',  [ParentController::class,'import'])->name('parents.import');


//Parent Data Route
Route::get('/allocation', [AllocationController::class,'create'])->name('allocation.create');
Route::post('/allocation/store', [AllocationController::class,'store'])->name('allocation.store');
Route::post('/allocation/view/{id}', [AllocationController::class,'view'])->name('allocation.view');

Route::get('/users/parent/discipline', [ParentController::class,'discipline'])->name('parents.discipline');

Route::post('/parents/view/child-performance', [ParentController::class,'child_performance'])->name('parents.child_performance');

Route::get('/parents/communication', [ParentController::class,'communication_index'])->name('parent.communication_index');


//Communication Management

Route::get('/communication', [CommunicationController::class,'index'])->name('communication.index');
Route::post('/communication/send', [CommunicationController::class,'store'])->name('communication.store');

//End of Communication Management

//Promotions Managements

Route::get('/promotions/', [ProgressionStatusController::class,'create'])->name('progression.create');
Route::post('/promotions/process', [ProgressionStatusController::class,'store'])->name('progression.store');
Route::post('/promotions/processing', [ProgressionStatusController::class,'processing'])->name('progression.processing');

//Promotions Management

//Attendence Route
// Route::get('/class/attendence', [AttendenceController::class,'create'])->name('attendence.create');
Route::get('/class/attendance/edit/{id}', [ParentController::class,'manage'])->name('attendence.edit');
Route::get('/class/attendance/search/{id}', [ParentController::class,'search'])->name('attendence.search');
Route::get('/kids/data/performance/{id}', [ParentController::class,'performance'])->name('kids.performance');

//Beginning of Class Teacher
Route::get('/class/student-attendance', [StudentAttendanceController::class,'index']); 
Route::get('/class/student-attendance/cumulative', [StudentAttendanceController::class,'create']);
Route::post('/class/student-attendance/cummulative-store', [StudentAttendanceController::class,'cummulative_store'])->name('attendance.cummulative_store');
Route::post('/class/student-attendance/mark-attendance', [StudentAttendanceController::class,'store'])->name('attendance.store');
Route::get('/class/student-attendance/manage', [StudentAttendanceController::class,'show']);
Route::post('/attendance/manage/view', [StudentAttendanceController::class,'edit']);


//End of Class Teacher

//Report Management

//Beginning of Report Settings



//Report Templates

Route::get('/report/templates', [ReportTemplateController::class,'index'])->name('report_template.index');
Route::post('/report/templates/store', [ReportTemplateController::class,'store'])->name('report_template.store');
Route::get('/report/templates/edit/{id}', [ReportTemplateController::class,'edit'])->name('report_template.edit');
Route::post('/report/templates/update', [ReportTemplateController::class,'update'])->name('report_template.update');
Route::get('/report/templates/delete/{id}', [ReportTemplateController::class,'destroy'])->name('report_template.delete');


//End of report templates

//Report Variables

Route::get('/report/variables', [ReportTemplateController::class,'variable'])->name('report_template.variable');
Route::post('/report/variable/store', [ReportTemplateController::class,'variable_store'])->name('report_template.variable_store');
Route::post('/report/variable/update', [ReportTemplateController::class,'variable_update'])->name('report_template.variable_update');
//End of report templates

//Report Variables

// Route::get('/report/individual', [ReportController::class,''])->name('report_template.variable');
// Route::post('/report/variable/store', [ReportTemplateController::class,'variable_store'])->name('report_template.variable_store');

// //End of report templates


//End of Report Settings

//Term Based
Route::get('/report/term-based', [ReportController::class,'create'])->name('report.create');
Route::get('/report/term-based/class', [ReportController::class,'class_index'])->name('report.class_index');
Route::get('/report/term-based/class/teacher', [ReportController::class,'classteacher_index']);
Route::get('/report/term-based/student', [ReportController::class,'create_student'])->name('report.create_student');
Route::post('/report/term-based/section/', [ReportController::class,'section'])->name('report.section');
Route::post('/report/term-based/stream/', [ReportController::class,'stream'])->name('report.stream');
//Route::post('/report/term-based/class/', [ReportController::class,'class'])->name('report.class');
Route::post('/report/term-based/student/', [ReportController::class,'student'])->name('report.student');

// Assessement Based Stream Report
Route::get('/report/assessement-based/', [ReportController::class,'assessement_based_index'])->name('report.assessment_based');
Route::post('/report/assessement-based/generate', [ReportController::class,'generate_assessement_report'])->name('report.stream-assessement-based');


//Open Day Report

Route::get('/report/openday/', [ReportController::class,'open_day_report_index'])->name('openday.create');
Route::post('/report/openday/process', [ReportController::class,'open_day_report_process'])->name('openday.process');



//Analytics-users

//insights routes
Route::get('/insights', [AnalyticsController::class,'create'])->name('analytics.create');
Route::get('/baseline', [AnalyticsController::class,'baseline_fetch'])->name('baseline.fetch_group');
Route::get('/category', [AnalyticsController::class,'category_fetch'])->name('category.fetch_group');

Route::post('/insights/generate', [AnalyticsController::class,'generate'])->name('insights.generate');


Route::get('/analytics/user/admin', [ParentController::class,'manage'])->name('analytics.admin');
Route::get('/analytics/user/teacher/', [ParentController::class,'manage'])->name('analytics.teacher');
Route::get('/analytics/user/student/', [ParentController::class,'manage'])->name('analytics.manage');
Route::get('/analytics/settings', [AnalyticsController::class,'settings'])->name('analytics.settings');

//Analytics-users
Route::get('/analytics/assessement-based', [AnalyticsController::class,'index'])->name('analytics.index');
Route::get('/analytics/assessement-based/class', [AnalyticsController::class,'class'])->name('analytics.class');
Route::get('/analytics/term-based', [AnalyticsController::class,'term_based'])->name('term_analytics.term');

Route::get('/analytics/term-based/class', [AnalyticsController::class,'term_based_class']);

Route::post('/analytics/term-based/show', [AnalyticsController::class,'term_based_show'])->name('term_analytics.show');

Route::post('/analytics/stream', [AnalyticsController::class,'stream'])->name('analytics.stream');
Route::post('/analytics/section', [AnalyticsController::class,'section'])->name('analytics.section');
Route::post('/analytics/class/', [AnalyticsController::class,'grade'])->name('analytics.grade');

Route::get('/analytics/subjects', [AnalyticsController::class,'subject_analytics']);
Route::post('/analytics/subjects/view', [AnalyticsController::class,'subject_analytics_view'])->name('analytics.subject');

Route::get('/analytics/subjects', [AnalyticsController::class,'subject_analytics']);
Route::get('/analytics/class-based/', [AnalyticsController::class,'class_based'])->name('analytics.class_based');
Route::post('/analytics/class-based/view/', [AnalyticsController::class,'class_based_store'])->name('analytics.class_based_store');

Route::get('/analytics/loads/check/{student_id}/{assessement_id}/', [AnalyticsController::class,'analytics_loads_check']);
Route::get('/analytics/loads/checker/{student_id}', [AnalyticsController::class,'analytics_loads_checker']);

Route::get('/ana/', [AnalyticsController::class,'term_based_ana']);

Route::get('/analytics/display/{assessement}/{indicator}/{stream}',[AnalyticsController::class, 'display'])->name('analytics.display');
Route::post('/promote/students', [PromotionsController::class,'promote'])->name('promotions.promote');
Route::post('/analytics/checker/class', [AnalyticsController::class,'term_based_show'])->name('class.check');
//Comments-users
Route::get('/comments/', [CommentSettingController::class,'index'])->name('comments.index');
Route::post('/comments/save', [CommentSettingController::class,'store'])->name('comments.store');
Route::get('/comments/edit', [CommentSettingController::class,'edit'])->name('comments.edit');
Route::post('/comments/delete', [CommentSettingController::class,'destroy'])->name('comments.destroy');

Route::get('/comments/manage/index', [CommentSettingController::class,'show'])->name('comments.show');
Route::post('/comments/manage/list', [CommentSettingController::class,'list'])->name('comments.list');
Route::post('/comments/manage/update', [CommentSettingController::class,'update'])->name('comments.update');
Route::get('/symbols', [MarkSymbolController::class,'index'])->name('symbols.index');
Route::get('/symbols/manage', [MarkSymbolController::class,'view'])->name('symbols.manage');
//end of comments



//Analytics-Marks
Route::get('/users/parent/discipline', [ParentController::class,'discipline'])->name('parents.discipline');

Route::get('livewire/modal-management',ModalManagement::class)->name('modal.management');

Route::get('/comment/report/{id}',[CommentSettingController::class, 'edit']);


//Beginning of Class NoticeBoard

Route::get('/class/class-noticeboard/', [ParentController::class,'discipline'])->name('parents.discipline');



//Virtual Meeting
//Route::get('/virtual/meeting', [VirtualMeetingController::class,'create'])->name('virtual.meeting');
Route::get('/virtual/class', [VirtualClassController::class,'create'])->name('virtual.class');
Route::post('/virtual/class/save', [VirtualClassController::class,'store'])->name('virtual-class.store');


//COVID-19 Module

Route::get('/covid-19/survelliance/students',[CoronaSurvellianceController::class, 'index_students'])->name('index.students');
Route::get('/covid-19/survelliance/visitors',[CoronaSurvellianceController::class, 'index_visitors'])->name('index.visitors');
Route::get('/covid-19/survelliance/teachers',[CoronaSurvellianceController::class, 'index_teachers'])->name('index.teachers');
Route::get('/covid-19/survelliance/support-stuff',[CoronaSurvellianceController::class, 'index_support_staff'])->name('index.support-staff');
});


//Register
Route::get('/student/register/',[StudentRegistrationController::class,'create'])->name('student_register.create');

Route::post('/students/get/',[StudentRegistrationController::class,'show'])->name('student_registration.show');
Route::post('/student/register/save',[StudentRegistrationController::class,'store'])->name('student_registration.store');




//End of Class Noticeboard


//OTP Verification
//Route that shows the verify form
Route::get('/verification/verify-otp',[VerificationController::class, 'index']);

//Route to process the form
Route::post('/verification/verify-otp/process',[VerificationController::class, 'process_otp'])->name('otp.process');

//Route to display form to send OTP's
Route::get('/verification/otp/send',[VerificationController::class, 'generateOtp_create']);


//Route
Route::get('/verification/otp/generate',[VerificationController::class, 'generateOtp']);


//Oauth
Route::get('/auth/google', [OauthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OauthController::class, 'handleGoogleCallback']);

// Route::get('/auth/facebook', [OauthController::class, 'redirectToFacebook'])->name('login');
// Route::get('auth/callback/callback', [OauthController::class, 'handleFacebookCallback'])->name('callback');

//End of Oauth


Route::get('/send/otps',[TeacherController::class, 'sendbulkOTPs']);
Route::get('/send/reminder',[TeacherController::class, 'sendReminders']);

//ErrorTool
Route::get('/error/tool/',[ErrorToolController::class, 'index'])->name('error_tool.index');


//Onboarding Routes
Route::get('/create/account/',[OnboardingController::class, 'index'])->name('onboarding.index');
Route::post('/create/account/step-1/',[OnboardingController::class, 'step_1'])->name('onboarding.step_1');
// Route::get('/create/account/step-1/{otp}',[OnboardingController::class, 'step_1_status'])->name('onboarding.step_1_status');
// Route::get('/create/account/otp',[OnboardingController::class, 'index'])->name('onboarding.index');
Route::post('/create/account/step-2/',[OnboardingController::class, 'step_2'])->name('onboarding.step_2');
Route::get('/onboarding/profile-setup/{user}',[OnboardingController::class, 'profile_setup'])->name('onboarding.profile_setup');
Route::post('/onboarding/profile-setup/step-2',[OnboardingController::class, 'step_3'])->name('onboarding.step_3');


//Route::get('/class/performance/',[OnboardingController::class, 'class_performance'])->name('onboarding.profile_setup');


//end of error tool


Route::get('/teacher/view/{id}',  [TeacherController::class,'show'])->name('teacher.show');

//Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);




Route::get('/clear-cache', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    $run = Artisan::call('storage:link');
    return 'FINISHED';  
});

Route::get('/cache', function() {
     Artisan::call('storage:link');

     return 'FINISHED';  
});



//end of registration
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});