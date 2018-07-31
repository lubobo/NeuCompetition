<?php

namespace App\Http\Controllers\Home;

use App\ComScore;
use App\Tea_Com;
use App\Team;
use App\TeamCompetition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Stu_Com;
use App\Competition;
use App\Student;
use Illuminate\Support\Facades\DB;
use Storage;

class TeacherController extends Controller
{
    public function teacherHome(){
        $teach=Teacher::where('name',session('user'))->first();               //个人信息部分
        $tea_coms=Tea_Com::where('tea_name',session('user'))->get();             //评审部分
        $teachers=TeamCompetition::where('teacher',session('user'))->get();     //指导赛事部分
        $team_teachers=Team::where('teacher_id',$teach->id)->get();            //所属团队部分
        $m=0;
        $map=array();
        foreach ($teachers as $teacher){
            $map[$m++]=Competition::where('name',$teacher->com_name)->value('com_time');
        }
        return view('teacher.teacherHome',[
            'teacher'=>$teach,
            'tea_coms'=>$tea_coms,
            'teachers'=>$teachers,
            'team_teachers'=>$team_teachers,
            'map'=>$map
        ]);
    }
    public function getDirection(Request $request){
        $teams=TeamCompetition::where(['com_name'=>$request['com_name'],'teacher'=>$request['teacher']])->paginate(5);
        $com=Competition::where('name',$request['com_name'])->first();
        return view('teacher.getDirection',['teams'=>$teams,'com'=>$com]);
    }
    public function getDirectionIn(Request $request){
        $team_com=TeamCompetition::where(['captain_num'=>$request['team_num'],'com_name'=>$request['com_name']])->first();
        $team=Team::where('leaderID',$request['team_num'])->first();
        $stu_teams=DB::table('student_team')->where('team_id', $team->id)->get();
        $m=0;
        $map=array();
        foreach ($stu_teams as$stu_team){
            $map[$m++]=Student::where('id',$stu_team->student_id)->first();
        }
//        return view('admin.teamCheck')->with(['team_com'=>$team_com,'team'=>$team,'map'=>$map,'stu_teams'=>$stu_teams]);
        return view('teacher.getDirectionIn',[
            'team_com'=>$team_com,
            'team'=>$team,'map'=>$map,
            'stu_teams'=>$stu_teams,
            'team_name'=>$team_com->team_name,
            'com_id'=>$request['com_id'],
            'status'=>$request['status'],
            'team_num'=>$team_com->captain_num,
            'teacher_feedback'=>$team_com->teacher_feedback
        ]);
    }
    public function getFile(Request $request)
    {

        if (Storage::exists($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'pics/')) {
            if ($request['type'] == '0') {
                if (Storage::exists($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'pics/' . $request['team_num'] . '.' . 'jpg')) {
                    return response()->download('uploads/' . $request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'pics/' . $request['team_num'] . '.' . 'jpg');
                }
                else {
                    return response()->download('uploads/' . $request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'pics/' . $request['team_num'] . '.' . 'png');
                }
            }
        }
        else{
            return redirect()->back()->with(['errors'=>'抱歉,没有上传图片信息']);
        }
        if (Storage::exists($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'files/')) {
            if ($request['type'] == '1') {
                if (Storage::exists($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'files/' . $request['team_num'] . '.' . 'docx')) {
                    return response()->download('uploads/' . $request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'files/' . $request['team_num'] . '.' . 'docx');
                }
                else {
                    return response()->download('uploads/' . $request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'files/' . $request['team_num'] . '.' . 'ppt');

                }
            }
        }
        else{
            return redirect()->back()->with(['errors'=>'抱歉,没有上传文档信息']);
        }
        if (Storage::exists($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'videos/')) {
            if ($request['type'] == '2') {
                if (Storage::exists($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'videos/' . $request['team_num'] . '.' . 'mp4')) {
                    return response()->download('uploads/' . $request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'videos/' . $request['team_num'] . '.' . 'mp4');

                }
                else {
                    return response()->download('uploads/' . $request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/' . 'videos/' . $request['team_num'] . '.' . 'avi');
                }
            }
        }
        else{
            return redirect()->back()->with(['errors'=>'抱歉,没有上传视频信息']);
        }
    }

    public function getReview(Request $request){
        $com=Competition::where('competition_id',$request['com_num'])->first();
        if ($com->status=='0'){
            $students=Stu_Com::where('com_name',$com->name)->get();
            $type='0';
        }
        else {
            $students=TeamCompetition::where(['com_name'=>$com->name,'teacher_feedback'=>'1'])->get();
            $type='1';
        }
        $m=0;
        $map=array();
        foreach ($students as $student){
            $map[$m++] = $student->feedback;
        }
        return view('teacher.getReview',['students'=>$students,'type'=>$type,'com_name'=>$com->name,'com_id'=>$com->competition_id,'map'=>$map,'grade'=>$com->grade]);
    }

    public function getReviewIn(Request $request){
        $team=TeamCompetition::where(['com_name'=>$request['com_name'],'captain_num'=>$request['stu_id']])->first();
        return view('teacher.getReviewIn',['com_id'=>$request['com_id'],'com_name'=>$request['com_name'],'type'=>$request['type'],'stu_id'=>$request['stu_id'],'grade'=>$request['grade'],'team'=>$team]);
    }
    public function postReviewIn(Request $request){
        $this->validate($request,[
            'score'=>'required|integer|min:0|max:100'
        ]);
        if ($request['type']=='0') {
            Stu_Com::where(['stu_num'=>$request['stu_id'],'com_name'=>$request['com_name']])->update(['feedback'=>$request['score'],'com_feedback'=>$request['status']]);

        }
        else
            TeamCompetition::where(['captain_num'=>$request['stu_id'],'com_name'=>$request['com_name']])->update(['feedback'=>$request['score'],'com_feedback'=>$request['status']]);
//        $com_score=new ComScore();
//        $com_score->stu_num=$request['stu_id'];
//        $com_score->stu_name=$stu_name;
//        $com_score->com_name=$request['com_name'];
//        $com_score->score=$request['score'];
//        $com_score->feedback=$request['status'];
//        $com_score->teacher=session('user');
//        $com_score->grade=$request['grade'];
//        $com_score->save();
        return redirect()->route('getReview',['com_num'=>$request['com_id']]);
    }

    public function sendData(Request $request){
        TeamCompetition::where(['captain'=>$request['captain'],'com_name'=>$request['com_name']])->update(['teacher_feedback'=>'1']);
        return redirect()->back();
    }
    public function backData(Request $request){
        TeamCompetition::where(['captain'=>$request['captain'],'com_name'=>$request['com_name']])->update(['teacher_feedback'=>'-1']);
        return redirect()->back()->with(['back'=>5]);
    }
}
