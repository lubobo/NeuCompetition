<?php

namespace App\Http\Controllers\Admin;

use App\Award;
use App\College;
use App\ComScore;
use App\Major;
use App\Student;
use App\Tea_Com;
use App\Teacher;
use App\Team;
use App\TeamCompetition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competition;
use App\Stu_Com;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Latrell\RongCloud\Facades\RongCloud;


class AdminController extends Controller
{
    public function admin_login(){
        return view('admin.admin_login');
    }

    public function getHome(){
//        $userId=session('num');
//        $name=session('user');
//        $portraitUri='http://www.tooopen.com/view/1027903.html';
//        $token=RongCloud::getToken($userId,$name,$portraitUri);
//        $token_status=json_encode($token);
//        dd($token_status);
        $competitions=Competition::orderBy('created_at','asc')->paginate(12);
        return view('admin.getAdmins',['competitions'=>$competitions]);
    }

    public function AddCompetition(){
        $colleges=College::orderBy('id','asc')->get();
        return view('admin.AddCompetition')->with('colleges',$colleges);
    }

//****************************************查看比赛系统*************************************************************************************//
    public function  GetCompetition(){
        $competitions=Competition::orderBy('competition_id','asc')->paginate(20);
        return view('admin.getCompetitions.getAdminlists',['competitions'=>$competitions]);
    }

    public function getAdminLists(){
        $competitions=Competition::orderBy('competition_id','asc')->paginate(20);
        return view('admin.getCompetitions.getAdminlists',['competitions'=>$competitions]);
    }

    public function getAdminOnTimeLists(){
        $competitions=Competition::orderBy('competition_id','asc')->paginate(20);
        return view('admin.getCompetitions.getOnTimeLists',['competitions'=>$competitions]);
    }

    public function getAdminNoTimeLists(){
        $competitions=Competition::orderBy('competition_id','asc')->paginate(20);
        return view('admin.getCompetitions.getNoTimeLists',['competitions'=>$competitions]);
    }

    public function getAdminOverTimeLists(){
        $competitions=Competition::orderBy('competition_id','asc')->paginate(20);
        return view('admin.getCompetitions.getOverTimeLists',['competitions'=>$competitions]);
    }

    public function AdminCompetitions($competition_id){
        $stu1=Stu_Com::where(['stu_name'=>session()->get('user'),'com_id'=>$competition_id])->first();
        if(!$stu1){
            {session()->put('old','0');}
        }
        else{
            {session()->put('old','1');}
        }
        $competition=Competition::where('competition_id',$competition_id)->first();
        $tea_coms=Tea_Com::where('com_name',$competition->name)->get();
        if ($competition->status=='1'){
            $team=TeamCompetition::where(['captain'=>session()->get('user'),'com_name'=>$competition->name])->first();
            if(!$team){
                {session()->put('old','0');}
            }
            else{
                {session()->put('old','2');}
            }
        }
        return view('admin.getCompetitions.AdminCompetition',['competition'=>$competition,'tea_coms'=>$tea_coms,'com_name'=>$competition->name]);
    }
//****************************************老师管理系统*************************************************************************************//

    public function getTeachers(Request $request){
        $teachers=Teacher::where('college_id',$request['college_id'])->get();
        $colleges=College::orderBy('id','asc')->get();
        $m=0;
        $map=array();
        foreach ($teachers as $teacher){
            if(Tea_Com::where(['tea_num'=>$teacher->num,'com_name'=>$request['com_name']])->first()){
                $map[$m++]=1;
            }else{
                $map[$m++]=0;
            }
        }
        return view('admin.teacherCheck',[
            'teachers'=>$teachers,
            'colleges'=>$colleges,
            'com_name'=>$request['com_name'],
            'com_num'=>$request['com_id'],
            'map'=>$map
        ]);
    }

    public function teacherCheck(Request $request){
        $tea_com = new Tea_Com();
        $tea_com->tea_num = $request['tea_num'];
        $tea_com->com_name = $request['com_name'];
        $tea_com->tea_name=$request['tea_name'];
        $tea_com->com_num=$request['com_num'];
        $tea_com->save();
        return redirect()->back();
    }

    public function timeCheck(Request $request){
        Tea_Com::where(['com_name'=>$request['com_name']])->update(['end_time'=>$request['end_time']]);
        return redirect()->route('adminHome');
    }


//****************************************学生报名审核系统*************************************************************************************//
    public function getAdminStudent(){
        if (session('role')=='admin'&&session('user')=='root') {
            $competitions = Competition::where(['grade'=>'1','status'=>'0'])->orderBy('competition_id', 'asc')->paginate(15);
            return view('admin.getAdminStudent')->with('competitions',$competitions);
        }
        elseif (session('role')=='admin'&&session('user')!='root'){
            $competitions=Competition::where(['organizer'=>session('user'),'status'=>'0'])->orWhere(['organizer'=>'ALL','status'=>'0'])->get();
            return view('admin.getAdminStudent')->with('competitions',$competitions);
        }
    }

    public function getStudents(Request $request){
        if(session('user')=='root'){
            $students=Stu_Com::where(['stu_status'=>'1','com_name'=>$request['com_name']])->
            orWhere(['stu_status'=>'','com_name'=>$request['com_name']])->orWhere(['stu_status'=>'2','com_name'=>$request['com_name']])->
            orWhere(['stu_status'=>'-2','com_name'=>$request['com_name']])->orderBy('com_id','asc')->paginate(8);
        }
        else $students=Stu_Com::where(['com_name'=>$request['com_name']])->orderBy('com_id','asc')->paginate(8);
        return view('admin.getStudents',['students'=>$students]);
    }

    public function adminCheck(Request $request){
        Stu_Com::where(['stu_name'=>$request['stu_name'],'com_name'=>$request['com_name']])->update(['stu_status'=>$request['com_status']]);
        return redirect()->back();
    }

//**************************************************团队报名审核系统****************************************************************************//
    public function getAdminTeam(){
        if (session('role')=='admin'&&session('user')=='root') {
            $competitions = Competition::where(['grade'=>'1','status'=>'1'])->orderBy('competition_id', 'asc')->paginate(15);
            return view('admin.getAdminStudent')->with('competitions',$competitions);
        }
        elseif (session('role')=='admin'&&session('user')!='root'){
            $competitions=Competition::where(['organizer'=>session('user'),'status'=>'1'])->orWhere(['organizer'=>'ALL','status'=>'1'])->get();
            return view('admin.getAdminStudent')->with('competitions',$competitions);
        }
    }

    public function getTeams(Request $request){
        if(session('user')=='root'){
            $teams=TeamCompetition::where(['team_status'=>'1','com_name'=>$request['com_name']])->
            orWhere(['team_status'=>'','com_name'=>$request['com_name']])->orWhere(['team_status'=>'2','com_name'=>$request['com_name']])->
            orWhere(['team_status'=>'-2','com_name'=>$request['com_name']])->orderBy('id','asc')->paginate(8);
        }
        else $teams=TeamCompetition::where(['com_name'=>$request['com_name']])->orderBy('id','asc')->paginate(8);
        return view('admin.getTeams',['teams'=>$teams]);
    }

    public function getTeamCheck(Request $request){
        $team_com=TeamCompetition::where(['teamID'=>$request->teamID,'com_name'=>$request->com_name])->first();
        $team=Team::where('teamID',$request->teamID)->first();
        $stu_teams=DB::table('student_team')->where('team_id', $team->id)->get();
        $m=0;
        $map=array();
        foreach ($stu_teams as$stu_team){
            $map[$m++]=Student::where('id',$stu_team->student_id)->first();
        }
        return view('admin.teamCheck')->with(['team_com'=>$team_com,'team'=>$team,'map'=>$map,'stu_teams'=>$stu_teams]);
    }

    public function postTeamCheck(Request $request){
        TeamCompetition::where([
            'team_name'=>$request['team_name'],
            'com_name'=>$request['com_name']])->update(['team_status'=>$request['team_status']]);
        return redirect()->back();
    }

    public function getAward(){
        $stu_coms=Stu_Com::where('stu_status','>','0')->value('com_name');
        $team_coms=TeamCompetition::where('feedback','>=','0')->get();
        $coms=Competition::orderBy('competition_id')->paginate('15');
        return view('admin.getAward',['stu_coms'=>$stu_coms,'team_coms'=>$team_coms,'coms'=>$coms]);
    }

    public function getAwardIn(Request $request){
        if ($request['status']=='0'){
            $stu_coms=Stu_Com::where(['com_name'=>$request['com_name']])->paginate(15);
            $m=0;
            $map=array();
            $map1=array();
            foreach ($stu_coms as $stu_com){
                $map[$m]=Student::where('name',$stu_com->stu_name)->first();
                $map1[$m]=Award::where(['competition_name'=>$request['com_name'],'num'=>$map[$m++]->num])->first();
                $m++;
            }
        }
        else {
            $stu_coms = TeamCompetition::where('com_name',$request['com_name'])->where('feedback','>=',0)->paginate(15);
            $m = 0;
            $n=0;
            $map = array();
            $map1=array();
            foreach ($stu_coms as $stu_com) {
                $map[$m] = Team::where('leaderID', $stu_com->captain_num)->first();
                $map1[$n]=Award::where(['competition_name'=>$request['com_name'],'num'=>$map[$m++]->leaderID])->first();
                $m++;
                $n++;
//                dump($map1[$n++]==null);
            }

        }
        return view('admin.getAwardIn',['stu_coms'=>$stu_coms,'status'=>$request['grade'],'com_id'=>$request['com_id'],'map'=>$map,'map1'=>$map1]);
    }

    public function adminStudent(Request $request){
        if ($request['college']!='选择学院'&&$request['college']!='all'&&$request['major']&&$request['major']!='选择专业'&&$request['major']!='all'){
            $major=Major::where(['major_name'=>$request['major']])->first();
            $students=Student::where(['major_id'=>$major->id])->paginate(15);
        }else
            $students=Student::where('id','>','0')->paginate(15);
        $colleges=College::all();
        return view('admin.adminStudent',['students'=>$students,'colleges'=>$colleges]);
    }

    public function delete_student(Request $request){
        dd($request['student_id']);
        Student::where(['id'=>$request['student_id']])->delete();
        return redirect()->back();
    }

    public function change_student(Request $request){
        Student::where(['id'=>$request['id']])->update(['password'=>md5($request['password'])]);
        return redirect()->back();
    }

    public function delete_all(Request $request){
        $datas=$request['data'];
        foreach ($datas as $data){
            Student::find($data)->delete();
        }
        return redirect()->route('adminStudent');
    }

    public function adminTeacher(Request $request){
        if ($request['college']!='选择学院'&&$request['major']&&$request['major']!='选择专业'){
            $teachers=Teacher::where(['subject'=>$request['major']])->paginate(15);
        }else
            $teachers=Teacher::where('id','>','0')->paginate(15);
        $colleges=College::all();
        return view('admin.adminTeacher',['teachers'=>$teachers,'colleges'=>$colleges]);
    }

    public function delete_teacher(Request $request){
        dd($request['teacher_id']);
        Student::where(['id'=>$request['teacher_id']])->delete();
        return redirect()->back();
    }

    public function change_teacher(Request $request){
        Teacher::where(['id'=>$request['id']])->update(['password'=>md5($request['password'])]);
        return redirect()->back();
    }

    public function delete_all_teacher(Request $request){
        $datas=$request['data'];
        foreach ($datas as $data){
            Teacher::find($data)->delete();
        }
        return redirect()->route('adminTeacher');
    }

    public function getAdminHelp(){
        return response()->download('uploads/' . '后台管理手册' . '.' . 'pdf');
    }
}