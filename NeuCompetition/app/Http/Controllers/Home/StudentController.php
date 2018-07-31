<?php

namespace App\Http\Controllers\Home;

use App\Award;
use App\Stu_Com;
use App\Student;
use App\Teacher;
use App\Team;
use App\TeamCompetition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competition;
use Illuminate\Support\Facades\DB;
use Storage;
use App\College;
use App\Major;

class StudentController extends Controller
{
    public function getHelp(){
        return response()->download('uploads/' . '系统使用手册' . '.' . 'pdf');
    }

    //自动提交信息到报名表,个人报名
    public function SignUp(Request $request)
    {
        $stu1 = Stu_Com::where(['stu_name' => $request->session()->get('user'), 'com_id' => $request->com_id])->first();
        if (!$stu1) {
            $com = Competition::where('competition_id', $request->com_id)->first();
            $stu = Student::where('name', $request->session()->get('user'))->first();
            $college = College::where('id', $stu->Major->college_id)->value('college_name');
            $SignUp = new Stu_Com();
            $SignUp->com_id = $request->com_id;
            $SignUp->com_name = $com->name;
            $SignUp->stu_name = $stu->name;
            $SignUp->stu_major = $stu->Major->major_name;
            $SignUp->stu_num = $stu->num;
            $SignUp->stu_bir_year = $stu->birth_year;
            $SignUp->stu_bir_month = $stu->birth_month;
            $SignUp->stu_cardID = $stu->cardID;
            $SignUp->stu_email = $stu->email;
            $SignUp->stu_phone_num = $stu->phone_num;
            $SignUp->com_status = $com->status;
            $SignUp->stu_colleges = $college;
            $SignUp->save();
            session()->put('old', '0');
        }
        session()->put('old', '1');
        return redirect()->route('competitions', ['competition_id' => $request->com_id]);
    }

    //自动提交信息到报名表,团队报名
    public function TeamSignUp(Request $request){

        $student=Student::where(['num'=>substr($request['team_id'],-8)])->first();
        $teacher_id=Team::where(['teamID'=>$request['team_id']])->value('teacher_id');
        $teacher=Teacher::where(['id'=>$teacher_id])->value('name');
        $team_com=new TeamCompetition();
        $team_com->teamID=$request['team_id'];
        $team_com->team_name=substr($request['team_id'],0,-8);
        $team_com->captain_num=substr($request['team_id'],-8);
        $team_com->captain=$student->name;
        $team_com->college=$student->Major->College->college_name;
        $team_com->major=$student->Major->major_name;
        $team_com->com_name=$request['com_name'];
        $team_com->teacher=$teacher;
        if (!empty($team_com->teacher)){
            $team_com->save();
            return redirect()->route('competitions',['competition_id'=>$request['com_id']]);
        }
        else
            return redirect()->route('competitions',['competition_id'=>$request['com_id']])->with(['errors'=>'抱歉，需要指定指导教师']);
    }

    //获取个人主页
    public function getHome()
    {
        $students = Stu_Com::where('stu_name', session('user'))->paginate(5);
        $teams=TeamCompetition::where('captain',session('user'))->paginate(5);
        $m=0;
        $map=array();
        $n=0;
        $map1=array();
        if (!$students->items()==[]){

            foreach ($students as $student)
            {
                $map[$m++]=Competition::where('competition_id',$student->com_id)->value('grade');

            }
        }
        elseif(!$teams->items()==[]){
            foreach ($teams as $team)
            {
                $map1[$n++]=Competition::where('name',$team->com_name)->value('grade');

            }
        }
        $student = Student::where('name', session('user'))->first();
        $message=$student->PM_noread;
        if($message==','){
            $message=0;
        }else{
            $message=1;
        }
        return view('student.myHome')->with([
            'students' => $students,
            'stu' => $student,
            'map'=>$map,
            'map1'=>$map1,
            'teams'=>$teams,
            'message'=>$message
        ]);
    }

    public function getSubmit(Request $request)
    {
//        $teacher_feedback=TeamCompetition::where(['com_name'=>$request['com_name'],'team_name'=>$request['team']])->value('teacher_feedback');
//        if ($teacher_feedback=='-1'){
//            session()->forget('picAgain');
//            session()->forget('fileAgain');
//            session()->forget('videoAgain');
//        }
        //个人上传模块**************************************************************************************************
        if(!empty($request['com_id'])) {
            session()->forget('pic');
            session()->forget('file');
            session()->forget('video');
            $competition = Competition::where('competition_id', $request['com_id'])->first();

            //验证图片上传否
            session()->forget('pic');
            if ($request['status']=='0'){
                $savePath = '0/' . $request['com_id'] . '/' . $request['stu_num'] . '/' . 'pics/';
            }
            else $savePath = '1/' . $request['com_id'] . '/' . $request['stu_num'] . '/' . 'pics/';
            if (Storage::exists($savePath)) {
                session()->put('pic','1');
            }
            else
                session()->put('pic','0');

            //验证文档上传否
            if ($request['status']=='0'){
                $savePath = '0/' . $request['com_id'] . '/' . $request['stu_num'] . '/' . 'files/';
            }
            else $savePath = '1/' . $request['com_id'] . '/' . $request['stu_num'] . '/' . 'files/';
            if (Storage::exists($savePath)) {
                session()->put('file', '1');
            }
            else
                session()->put('file', '0');

            //验证视频上传否
            if ($request['status']=='0'){
                $savePath = '0/' . $request['com_id'] . '/' . $request['stu_num'] . '/' . 'videos/';
            }
            else $savePath = '1/' . $request['com_id'] . '/' . $request['stu_num'] . '/' . 'videos/';
            if (Storage::exists($savePath)) {
                session()->put('video', '1');
            }
            else
                session()->put('video', '0');

            //返回视图
            return view('student.submitData', ['com' => $competition]);
        }

        //团队上传模块***********************************************************************************************************
        else{
            session()->forget('pic');
            session()->forget('file');
            session()->forget('video');
            $competition = Competition::where('name', $request['com_name'])->first();
            $teacher=TeamCompetition::where(['team_name'=>$request['team'],'com_name'=>$request['com_name']])->first();
            if (!empty($teacher->feedback)){
                $award=Award::where(['name'=>$teacher->captain,'competition_name'=>$teacher->com_name])->first();
                if($award!='0'){
                    $award=$award->award_info;
                }
                else
                    $award=1;
            }
            else
                $award=-1;
            //验证图片上传否
            if ($request['status']=='0'){
                $savePath = '0/' . $competition->competition_id . '/' . $teacher->captain_num . '/' . 'pics/';
            }
            else $savePath = '1/' . $competition->competition_id . '/' . $teacher->team_name . '/' . 'pics/';
            if (Storage::exists($savePath)) {
                session()->put('pic', '1');
            }
            else
                session()->put('pic', '0');
            //验证文档上传否
            if ($request['status']=='0'){
                $savePath = '0/' . $competition->competition_id . '/' . $teacher->captain_num . '/' . 'files/';
            }
            else $savePath = '1/' . $competition->competition_id . '/' . $teacher->team_name . '/' . 'files/';
            if (Storage::exists($savePath)) {
                session()->put('file', '1');
            }
            else
                session()->put('file', '0');

            //验证视频上传否
            if ($request['status']=='0'){
                $savePath = '0/' . $competition->competition_id . '/' . $teacher->captain_num . '/' . 'videos/';
            }
            else $savePath = '1/' . $competition->competition_id . '/' . $teacher->team_name . '/' . 'videos/';
            if (Storage::exists($savePath)) {
                session()->put('video', '1');
            }
            else
                session()->put('video', '0');

            //返回视图
            return view('student.submitData', ['award'=>$award,'com' => $competition,'teacher_feedback'=>$teacher->teacher_feedback,'teacher'=>$teacher]);
        }
    }

    //竞赛文件上传
    public function postFile(Request $request)
    {
        if (!empty($request->file())) {
            $file = $request->file('pics');
            if ($file) {
                if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png') {
                    $stu_id=Student::where(['name'=>session('user')])->value('num');
                    $team_name=TeamCompetition::where('captain',session('user'))->value('team_name');
                    $newFilename = $stu_id . '.' . $file->getClientOriginalExtension();
                    $com_id = $request['com_id'];
                    if ($request['status']=='0'){
                        $savePath = '0/' . $com_id . '/' . $stu_id . '/' . 'pics/' . $newFilename;
                    }
                    else $savePath = '1/' . $com_id . '/' . $team_name . '/' . 'pics/' . $newFilename;
                    if (Storage::exists($savePath)) {
                        session()->put('pic', '1');
                        return redirect()->back();
                    }
                    else
                        Storage::put(
                            $savePath,
                            file_get_contents($file->getRealPath())
                        );
                    session()->put('pic', '1');
                    return redirect()->back();
                }
                else
                    exit('上传图片格式不正确');
            }

            $file1 = $request->file('file');
            if ($file1) {
                if ($file1->getClientOriginalExtension() == 'docx' || $file1->getClientOriginalExtension() == 'ppt') {
                    $stu_id=Student::where(['name'=>session('user')])->value('num');
                    $team_name=TeamCompetition::where('captain',session('user'))->value('team_name');
                    $newFilename = $stu_id . '.' . $file1->getClientOriginalExtension();
                    $com_id = $request['com_id'];
                    if ($request['status']=='0'){
                        $savePath = '0/' . $com_id . '/' . $stu_id . '/' . 'files/' . $newFilename;
                    }
                    else $savePath = '1/' . $com_id . '/' .  $team_name . '/' . 'files/' . $newFilename;
                    if (Storage::exists($savePath)) {
                        session()->put('file', '1');
                        return redirect()->back();
                    }
                    else
                        Storage::put(
                            $savePath,
                            file_get_contents($file1->getRealPath())
                        );
                    session()->put('file', '1');
                    return redirect()->back();
                }
                else
                    exit('上传文档格式不正确');
            }

            $file2 = $request->file('video');
            if ($file2) {
                if ($file2->getClientOriginalExtension() == 'mp4' || $file2->getClientOriginalExtension() == 'avi') {
                    $stu_id=Student::where(['name'=>session('user')])->value('num');
                    $team_name=TeamCompetition::where('captain',session('user'))->value('team_name');
                    $newFilename = $stu_id . '.' . $file2->getClientOriginalExtension();
                    $com_id = $request['com_id'];
                    if ($request['status']=='0'){
                        $savePath = '0/' . $com_id . '/' .  $stu_id . '/' . 'videos/' . $newFilename;
                    }
                    else $savePath = '1/' . $com_id . '/' .  $team_name . '/' . 'videos/' . $newFilename;
                    if (Storage::exists($savePath)) {
                        session()->put('video', '1');
                        return redirect()->back();
                    }
                    else
                        Storage::put(
                            $savePath,
                            file_get_contents($file2->getRealPath())
                        );
                    session()->put('video', '1');
                    return redirect()->back();
                }
                else
                    exit('上传视频格式不正确');
            }
        } else return redirect()->back();
    }

    public function finish_submit(Request $request){
        TeamCompetition::where(['com_name'=>$request['com_name'],'captain'=>$request['name']])->update(['teacher_feedback'=>2]);
        return redirect()->back();
    }

//    public function PostFileAgain(Request $request){
//        if (!empty($request->file())) {
//            $file = $request->file('pics');
//            if ($file) {
//                if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png') {
//                    $stu_id = Student::where(['name' => session('user')])->value('num');
//                    $team_name = TeamCompetition::where('captain', session('user'))->value('team_name');
//                    $newFilename = $stu_id . '.' . $file->getClientOriginalExtension();
//                    $com_id = $request['com_id'];
//                    if ($request['status'] == '0') {
//                        $savePath = '0/' . $com_id . '/' . $stu_id . '/' . 'pics/' . $newFilename;
//                    } else $savePath = '1/' . $com_id . '/' . $team_name . '/' . 'pics/' . $newFilename;
//                    if (Storage::exists($savePath)) {
//                        Storage::delete($savePath);
//                        Storage::put(
//                            $savePath,
//                            file_get_contents($file->getRealPath())
//                        );
//                        session()->put('picAgain', '2');
//                        return redirect()->back();
//                    }
//                }
//                    else
//                        exit('上传图片格式不正确');
//                }
//
//                $file1 = $request->file('file');
//                if ($file1) {
//                    if ($file1->getClientOriginalExtension() == 'docx' || $file1->getClientOriginalExtension() == 'ppt') {
//                        $stu_id = Student::where(['name' => session('user')])->value('num');
//                        $team_name = TeamCompetition::where('captain', session('user'))->value('team_name');
//                        $newFilename = $stu_id . '.' . $file1->getClientOriginalExtension();
//                        $com_id = $request['com_id'];
//                        if ($request['status'] == '0') {
//                            $savePath = '0/' . $com_id . '/' . $stu_id . '/' . 'files/' . $newFilename;
//                        } else $savePath = '1/' . $com_id . '/' . $team_name . '/' . 'files/' . $newFilename;
//                        if (Storage::exists($savePath)) {
//                            session()->put('file', '1');
//                            Storage::delete($savePath);
//                            Storage::put(
//                                $savePath,
//                                file_get_contents($file1->getRealPath())
//                            );
//                            session()->put('fileAgain', '2');
//                            return redirect()->back();
//                        }
//                    }
//                    else
//                        exit('上传文档格式不正确');
//                }
//
//                $file2 = $request->file('video');
//                if ($file2) {
//                    if ($file2->getClientOriginalExtension() == 'mp4' || $file2->getClientOriginalExtension() == 'avi') {
//                        $stu_id = Student::where(['name' => session('user')])->value('num');
//                        $team_name = TeamCompetition::where('captain', session('user'))->value('team_name');
//                        $newFilename = $stu_id . '.' . $file2->getClientOriginalExtension();
//                        $com_id = $request['com_id'];
//                        if ($request['status'] == '0') {
//                            $savePath = '0/' . $com_id . '/' . $stu_id . '/' . 'videos/' . $newFilename;
//                        } else $savePath = '1/' . $com_id . '/' . $team_name . '/' . 'videos/' . $newFilename;
//                        if (Storage::exists($savePath)) {
//                            Storage::delete($savePath);
//                            Storage::put(
//                                $savePath,
//                                file_get_contents($file2->getRealPath())
//                            );
//                            session()->put('videoAgain', '2');
//                            return redirect()->back();
//                        } else
//                            exit('上传视频格式不正确');
//                    }
//                }
//            } else return redirect()->back();
//        }

    public function refresh(Request $request){
        Storage::deleteDirectory($request['status'] . '/' . $request['com_id'] . '/' . $request['team_name'] . '/');
        return redirect()->back();
    }
}