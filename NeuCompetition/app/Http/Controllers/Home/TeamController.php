<?php

namespace App\Http\Controllers\Home;

use App\College;
use App\Student;
use App\Teacher;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function list_(){
        $team_creates=Team::where('leaderID',session('num'))->get();
        $team_join=Student::where('num',session('num'))->first()->teams()->get();
        return view('team.list')->withCreates($team_creates)->withJoins($team_join);
    }
    public function create(){
        return view('team.create');
    }
    public function store(Request $request){
        $map['name']=$request['name'];
        $map['leaderID']=session('num');
        $map['teamID']=$request['name'].session('num');
        $map['team_info']=$request['info'];
        $team=Team::create($map);
        if($team->save()){
            return redirect()->route('team_list');
        }
        else{
            return redirect()->back()->withInput()->withError('wrong');
        }
//        return view('team.store');
    }
    public function verify(Request $request){
        $name=$request['name'];
        if(strlen($name)==0){
            echo 'name is must';
        }
        elseif(Team::where('name',$name)->first()){
            echo 'has been registered';
        }
        else{
            echo 'nice';
        }
    }
    public function join(){
        return view('team.join');
    }
    public function join_process(Request $request){
        $team_id=$request['team_id'];
        if($team=Team::where('teamID',$team_id)->first()){
            if($team->leaderID==session('num')){
                return redirect()->back()->withMessage('兄弟阿!没事多学习!开发者QQ1440852110');
            }
            else{
                $joiner_num=session('num');
                return redirect()->route('join_team',[$joiner_num,$team_id]);
            }
        }
        else{
            return redirect()->back()->withMessage('TeamID不存在');
        }

//        echo $team_id.''.$joiner_num;
//        echo '申请已经提交';
    }
    public function team_quit($team_id){
        $team=Team::find($team_id);
        $team->team_count--;
        $team->save();
        $student_id=Student::where('num',session('num'))->first()->id;
        $team_id=$team->id;
        DB::table('student_team')->where('student_id',$student_id)->where('team_id',$team_id)->delete();
        return redirect(route('quit_team',[$team->name]));
    }
    public function team_dissolved($team_id){
        $team=Team::where('teamID',$team_id)->first();
        $team_id=$team->id;
        $team_name=$team->name;
        $team_count=$team->team_count;
        $teacher_id=$team->teacher_id;
        $team->delete();
        if(!$team_count){
            return redirect()->back();
        }else{
            return redirect()->route('dissolved_team',[$team_id,$team_name,$team_count,$teacher_id]);
        }
    }
    public function invite_teacher($teamID){
        $leader=Student::where('num',session('num'))->first();
//        dd($leader);
        $college=$leader->major()->first()->college()->first();
        $college_name=$college->college_name;
        $teachers=College::where('college_name',$college_name)->first()->teachers()->get();
        $college=College::all();
        return view('team.invite_teacher')->withTeachers($teachers)->withCollege_name($college_name)->withTeam_id($teamID)->withColleges($college);
    }
    public function invite_teacher_process(Request $request){
        $college=$request['college'];
        $teachers=College::where('college_name',trim($college))->first()->teachers()->get();
        $i=0;
        $map=array();
        foreach ($teachers as $teacher){
            $map[$i][0]=$teacher->name;
            $map[$i][1]=$teacher->num;
        }
//        dd($teachers);
//        $map[0]='123';
        return response()->json($map);
    }
    public function my_team($role,$team_id){
//        dd($team_id);
        $student_teams=DB::table('student_team')->where('team_id',$team_id)->get();
        $i=0;
        $students=array();
        foreach ($student_teams as $student_team) {
            $students[$i][0] = $student_team->student_id;
            $students[$i][1] = Student::find($students[$i][0])->name;
            $i++;
        }
        $team=Team::find($team_id);
        if($role!='creator'){
            $leader=Student::where('num',$team->leaderID)->first()->name;
        }else{
            $leader='me';
        }
        if($team->teacher_id>=1){
            $teacher=$team->teacher()->first();
            $team_teacher=$teacher->name;
        }
        elseif ($team->teacher_id==-1){
            $team_teacher='我团队已经发出邀请，情等待老师回复';
        }
        else{
            $team_teacher=0;
        }
        $data=array(
            'team'=>$team,
            'team_teacher'=>$team_teacher,
            'team_name'=>$team->name,
            'leader'=>$leader,
            "teamID"=>$team_id,
            'students'=>$students,
            'role'=>$role
        );
        return view('team.my_team')->with($data);
    }
    public function fire($student_id,$team_id){
        $team=Team::find($team_id);
        $team->team_count--;
        $team->save();
        $team_id=$team->id;
        DB::table('student_team')->where('student_id',$student_id)->where('team_id',$team_id)->delete();
        return redirect(route('fire_team',[$team->name,$student_id]));
    }
//    public function quit
}
