<?php

namespace App\Http\Controllers\Home;

use App\Message;
use App\Student;
use App\Teacher;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function join_team($joiner_num,$team_id){
        $joiner_name=Student::where('num',$joiner_num)->first()->name;
        $team=Team::where('teamID',$team_id)->first();
        $team_name=$team->name;
        $leader_id=$team->leaderID;
        $message_info=$joiner_name.'小盆友 申请加入本寡人的团队-->'.$team_name;
        if(Message::where('readed',0)->where('message_info',$message_info)->first()){
            return redirect()->route('team_join')->withMessage('小伙,乖乖等你队长批阅');
        }
        else{
            $map['message_sorts_id']=1;
            $map['message_info']=$message_info;
            $map['message_url']=route('join_team_details',[$joiner_num,$team_id,'']);
            $map['readed']=0;
            $message=Message::create($map);
            if($message->save()){
                $leader=Student::where('num',$leader_id)->first();
                $leader->PM_noread=','.$message->id.$leader->PM_noread;
                $leader->save();
                return redirect()->route('team_join')->withMessage('申请成功,请等待队长同意');
            }
            else{
                return redirect()->route('team_join')->withMessage('申请失败');
            }
        }

    }
    public function reply_join_team($joiner_id,$team_name,$status){
        if($status==1){
            $map['message_info']=$team_name.'团队同意我加入，现在我已经是'.$team_name.'的一员了～～';
        }else{
            $map['message_info']=$team_name.'团队拒绝了我加入申请';
        }
        $map['message_sorts_id']=4;
        $map['message_url']='#';
        $map['readed']=0;
        $message=Message::create($map);
        if($message->save()){
            $student=Student::find($joiner_id);
            $student->PM_noread=','.$message->id.$student->PM_noread;
            $student->save();
        }
        return redirect()->route('message_personal');
    }
    public function quit_team($team_name){
        $map['message_info']=session('user').'退出了我的团队'.$team_name;
        $map['message_sorts_id']=3;
        $map['message_url']='#';
        $map['readed']=0;
        $message=Message::create($map);
        if($message->save()){
            $team=Team::where('name',$team_name)->first();
            $student=Student::where('num',$team->leaderID)->first();
            $student->PM_noread=','.$message->id.$student->PM_noread;
            $student->save();
        }
        return redirect(route('team_list'));
    }
    public function dissolved_team($team_id,$team_name,$team_count,$teacher_id){
        $map['message_info']=$team_name.'团队已经被解散';
        $map['message_sorts_id']=15;
        $map['message_url']='#';
        $map['readed']=$team_count;
        $message=Message::create($map);
        if($message->save()){
            if($teacher=Teacher::find($teacher_id)){
                $teacher->TM_noread=','.$message->id.$teacher->TM_noread;
                $teacher->save();
            }
            $student_teams=DB::table('student_team')->where('team_id',$team_id)->get();
            foreach ($student_teams as $student_team){
                $student_id=$student_team->student_id;
                $student=Student::find($student_id);
                $student->TM_noread=','.$message->id.$student->TM_noread;
                $student->save();
            }
            DB::table('student_team')->where('team_id',$team_id)->delete();
        }
        return redirect(route('team_list'));
    }
    public function invite_teacher(Request $request){
        $team_id=$request['team_id'];
        $team=Team::where('teamID',$team_id)->first();
        $message_info=$team->name.'团队邀请我为该团队的指导老师';
        $team->teacher_id=-1;
        $team->save();
        $map['message_sorts_id']=6;
        $map['message_info']=$message_info;
        $map['message_url']=route('invite_teacher_details',[$team_id,'']);
        $map['readed']=0;
        $message=Message::create($map);
        if($message){
            $teacher_num=$request['teacher_num'];
            $teacher=Teacher::where('num',$teacher_num)->first();
            $teacher->PM_noread=','.$message->id.$teacher->PM_noread;
            $teacher->save();
            return redirect()->route('my_team',['creator',$team->id]);
        }
    }
    public function reply_invite_teacher($teacher_name,$team_id,$status){
        $team=Team::find($team_id);
        $leader=Student::where('num',$team->leaderID)->first();
        if($status==1){
            $map['message_info']=$teacher_name.'老师同意我的了邀请';
        }else{
            $map['message_info']=$teacher_name.'老师拒绝我的了邀请';
        }
        $map['message_sorts_id']=2;
        $map['message_url']='#';
        $map['readed']=0;
        $message=Message::create($map);
        if($message->save()){
            $leader->PM_noread=','.$message->id.$leader->PM_noread;
            $leader->save();
        }
        return redirect()->route('message_personal');
    }
    public function become_competition_rater($teacher_id,$competition_name){
        $map['message_info']='本人被请出山成为竞赛'.'"'.$competition_name.'"'.'RATER';
        $map['message_sorts_id']=7;
        $map['message_url']='#';
        $map['readed']=0;
        $message=Message::create($map);
        if($message->save()){
            $teacher=Team::find($teacher_id);
            $teacher->PM_noread=','.$message->id.$teacher->PM_noread;
            $teacher->save();
        }
//        return redirect(route('team_list'));
        //此处填写要到达的地区
    }
    public function replay_signup($type,$status,$competition_name,$join_id){
        $map['readed']=0;
        $map['message_url']='#';
        if ($type=='team'){
            $team=Team::find($join_id);
            $map['message_sorts_id']=9;
            if($status){
                $map['message_info']='我的团队'.$team->name.'报名的比赛'.$competition_name.'通过了管理员的审核';
            }
            else{
                $map['message_info']='我的团队'.$team->name.'报名的比赛'.$competition_name.'未通过管理员的审核';
            }
            $message=Message::create($map);
            if($message->save()){
                $leader=Student::where('num',$team->leaderID)->first();
                $leader->PM_noread=','.$message->id.$leader->PM_noread;
                $leader->save();
            }
        }

        else{
            $map['message_sorts_id']=10;
            if ($status){
                $map['message_info']='我报名的比赛'.$competition_name.'通过了管理员的审核';
            }else{
                $map['message_info']='我报名的比赛'.$competition_name.'通过了管理员的审核';
            }
            $message=Message::create($map);
            if($message->save()){
                $student=Student::find($join_id);
                $student->PM_noread=','.$message->id.$student->PM_noread;
                $student->save();
            }
        }
//        return redirect(route('team_list'));
        //此处填写要到达的地区
    }
    public function fire_team($team_name,$student_id){
        $map['message_info']=$team_name.'把我提出了团队';
        $map['message_sorts_id']=5;
        $map['message_url']='#';
        $map['readed']=0;
        $message=Message::create($map);
        if($message->save()){
            $student=Student::find($student_id);
            $student->PM_noread=$student->PM_noread.$message->id.',';
            $student->save();
        }
        $team_id=Team::where('name',$team_name)->first()->id;

        return redirect()->route('my_team',['creator',$team_id]);
    }
}
