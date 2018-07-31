<?php

namespace App\Http\Controllers\Home;

use App\Student;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TeamProcessController extends Controller
{
    public function search_team(Request $request){
        //for 团队报名时的查询
        if($team=Team::where('teamID',$request['teamID'])->first()){
            $student_teams=DB::table('student_team')->where('team_id',$request['teamID'])->get();
            $students='';
            foreach ($student_teams as $student_team) {
                $students=$students.Student::find($student_team->student_id)->name.' ';
            }
            if (!strlen($students)){
                $students='暂无';
            }
            if($team->teacher_id>=1){
                $teacher=$team->teacher()->first();
                $teacher_name=$teacher->name;
            }
            elseif ($team->teacher_id==-1){
                $teacher_name='正在邀请';
            }
            else{
                $teacher_name='暂无';
            }
            if($team->leaderID==$request['student_num']){
                $data['status']='true';
                $data['name']=$team->name;
                $data['members']=$students;
                $data['teacher']=$teacher_name;
            }else{
                $data['status']='false';
            }
        }
        else{
            $data['status']='false';
        }
        return response()->json($data);
    }
}
