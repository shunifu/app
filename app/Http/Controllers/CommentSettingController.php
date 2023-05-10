<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\ReportComment;
use App\Models\CommentSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportCommentController;

class CommentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->hasRole('admin_teacher')){
            $user_type="1";
        }elseif(Auth::user()->hasRole('school-administrator')){
            $user_type="2";
        }elseif(Auth::user()->hasRole('class-teacher')){
             $user_type="0";
        }
        // $comments=CommentSetting::all();
        $commentss = DB::table('report_comments')
        ->join('sections', 'sections.id', '=', 'report_comments.section_id')
        ->select('report_comments.*','sections.section_name')
        ->where('user_type',$user_type)
        ->get();

        $comments=json_decode($commentss);
        
       
        $sections=Section::all();
        
       return view('academic-admin.comments-management.index',compact('comments', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $isAdmin=Auth::user()->hasRole('admin_teacher');
        $isPrincipal=Auth::user()->hasRole('school-administrator');
        $isDeputy=Auth::user()->hasRole('deputy');
        $isClassTeacher=Auth::user()->hasRole('class_teacher');

        if ($isAdmin || $isPrincipal ||  $isDeputy || $isClassTeacher) {
         

            //Validations

            $validation=$request->validate([
                'section'=>'required',
                'from'=>'required|numeric', 
                'to'=>'required|numeric',
                'symbol'=>'required',
                'comment'=>'required',
        ]);



            $user_type=$request->comment_category;
       
    // $rangeExists=CommentSetting::where('section_id', $request->section)->where('from',$request->from)->where('to',$request->to)->where('user_type',$user_type)->exists();
    // $commentExists=CommentSetting::where('section_id', $request->section)->where('from',$request->from)->where('to',$request->to)->where('comment',$request->comment)->where('user_type',$user_type)->exists();

    //     if($commentExists OR $rangeExists ){
    //         flash()->overlay('<i class="fas fa-check-circle text-warning"></i> Error. That comment exists in the system', 'Add Comment');

	// 		return redirect('/comments/');
    //     }else{

            CommentSetting::create([

                'section_id'=>$request->section,
                'from'=>$request->from,
                'to'=>$request->to,
                'symbol'=>$request->symbol,
                'comment'=>$request->comment,
                'user_type'=>$user_type
             
            ]);

            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. Comment has been successfully added', 'Add Comment');

			return redirect('/comments/');

        // }

        
       
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentSetting  $commentSetting
     * @return \Illuminate\Http\Response
     */
    public function show(CommentSetting $commentSetting, Request $request)

    {

        $sections=Section::all();
        return view('academic-admin.comments-management.manage',compact('sections'));
      
    }
    public function list(Request $request){

        $section=Section::find($request->section);

        if($request->comment_category==1){

$name="Subject Comments";
        }else if($request->comment_category==2){
            $name="Principal Comments";
        }else if($request->comment_category==3){
            $name="ClassTeacher Comments";
        }

        $comments=CommentSetting::where('user_type', $request->comment_category)->where('section_id', $request->section)->orderByDesc('from')->get();
        return view('academic-admin.comments-management.view',compact('comments', 'section', 'name'));
    }


    // public function update(Request $request){
        
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentSetting  $commentSetting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$comment_edit=CommentSetting::find($id);

        $comment_edit = DB::table('report_comments')
            ->join('sections', 'sections.id', '=', 'report_comments.section_id')
            ->select('report_comments.id as id', 'sections.section_name', 'report_comments.section_id', 'comment','symbol', 'from', 'to')
            ->get();

           
       
        return response()->json($comment_edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommentSetting  $commentSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentSetting $commentSetting)
    {
        if ($request->ajax()) {
        
            CommentSetting::find($request->pk)
                ->update([
                    'comment' => $request->value
                ]);
  
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentSetting  $commentSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentSetting $commentSetting)
    {
        //
    }
}
