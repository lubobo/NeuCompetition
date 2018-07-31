<?php

namespace App\Http\Controllers\Home;

use App\Admin;
use App\Message;
use App\Student;
use App\Teacher;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageProcessController extends Controller
{
    public function message_operate($message_id,$type){
        //本方法来处理消息列表的通用消息
        //默认：个人删除--->0  忽略/标记已读-----1
        //     团队删除--->2  团队标记已读------>3
        if(session('role')=='student'){
            $user=Student::where('num',session('num'))->first();
        }
        elseif (session('role')=='teacher'){
            $user=Teacher::where('num',session('num'))->first();
        }
        else{
            $user=Admin::find(session('num'));
        }

        if($type=='0-n'){
                $user->PM_noread=preg_replace('/,'.$message_id.',/',',',$user->PM_noread);
                $user->save();
            Message::find($message_id)->delete();
        }
        elseif ($type=='0-r'){
            $user->PM_read=preg_replace('/,'.$message_id.',/',',',$user->PM_read);
            $user->save();
            Message::find($message_id)->delete();
        }
        elseif ($type==1){
            //修改个人信息表
            $user->PM_read=','.$message_id.$user->PM_read;
            $user->PM_noread=preg_replace('/,'.$message_id.',/',',',$user->PM_noread);
            $user->save();
            //修改消息总表
            $message=Message::find($message_id);
            $message->readed=1;
            $message->save();
        }
        elseif ($type=='2-n'){
            //修改个人信息表
            $user->TM_noread=preg_replace('/,'.$message_id.',/',',',$user->TM_noread);
            $user->save();
            //修改消息总表
            $message=Message::find($message_id);
            if(!--$message->readed){
                $message->delete();
            }else{
                $message->save();
            }
        }
        elseif ($type=='2-r'){
            //修改个人信息表
            $user->TM_read=preg_replace('/,'.$message_id.',/',',',$user->TM_read);
            $user->save();
            //修改消息总表
            $message=Message::find($message_id);
            if(!--$message->readed){
                $message->delete();
            }else{
                $message->save();
            }
        }elseif (3){
            //修改个人信息表
            $user->TM_read=','.$message_id.$user->TM_read;
            $user->TM_noread=preg_replace('/,'.$message_id.',/',',',$user->TM_noread);
            $user->save();
        }
        return redirect()->back();
    }
    public function join_team_process(Request $request){
        if($request['status']==1){
            //同意
            $team=Team::where('teamID',$request['team_id'])->first();
//            第1步，修改team表和student_team表
            $team->team_count++;
            $team->save();
            $joiner_id=Student::where('num',$request['joiner_num'])->first()->id;
            DB::insert('insert into student_team (team_id, student_id) values ('.'"'.$team->id.'"'.','.'"'.$joiner_id.'"'.')');
            //第2步，修改个人消息数据
            $leader=Student::where('num',$team->leaderID)->first();
            $leader->PM_read=','.$request['message_id'].$leader->PM_read;
            /*
             * 字符串的剔除
             * $string = 'fdjborsnabcdtghrjosthabcrgrjtabc';
             * $string = preg_replace('/[abc]+/i','',$string);
             */
            $leader->PM_noread=preg_replace('/,'.$request['message_id'].',/',',',$leader->PM_noread);
            $leader->save();
//            第3步，修改消息总表
            $message=Message::find($request['message_id']);
            $message->readed=1;
            $message->save();
//            //第四步发送消息
            return redirect()->route('reply_join_team',[$joiner_id,$team->name,1]);
        }else{
            $team=Team::where('teamID',$request['team_id'])->first();
            //第2步，修改个人消息数据
            $leader=Student::where('num',$team->leaderID)->first();
            $leader->PM_read=','.$request['message_id'].$leader->PM_read;
            /*
             * 字符串的剔除
             * $string = 'fdjborsnabcdtghrjosthabcrgrjtabc';
             * $string = preg_replace('/[abc]+/i','',$string);
             */
            $leader->PM_noread=preg_replace('/,'.$request['message_id'].',/',',',$leader->PM_noread);
            $leader->save();
            //第3步，修改消息总表
            $message=Message::find($request['message_id']);
            $message->readed=1;
            $message->save();
            //            //第四步发送消息
            $joiner_id=Student::where('num',$request['joiner_num'])->first()->id;
            return redirect()->route('reply_join_team',[$joiner_id,$team->name,0]);
        }
    }
    public function invite_teacher_process(Request $request){
        //同意
        if($request['status']==1){
            $team=Team::find($request['team_id']);
//            第1步，修改team表
            $teacher=Teacher::where('num',session('num'))->first();
            $team->teacher_id=$teacher->id;
            $team->save();
            //第2步，修改个人消息数据
            $teacher->PM_read=','.$request['message_id'].$teacher->PM_read;
            $teacher->PM_noread=preg_replace('/,'.$request['message_id'].',/',',',$teacher->PM_noread);
            $teacher->save();
//            第3步，修改消息总表
            $message=Message::find($request['message_id']);
            $message->readed=1;
            $message->save();
//            //第四步发送消息
            return redirect()->route('reply_invite_teacher',[session('user'),$team->id,1]);
        }else{
            //不同意
            $team=Team::find($request['team_id']);
//            第1步，修改team表
            $teacher=Teacher::where('num',session('num'))->first();
            $team->teacher_id=0;
            $team->save();
            //第2步，修改个人消息数据
            $teacher->PM_read=','.$request['message_id'].$teacher->PM_read;
            $teacher->PM_noread=preg_replace('/,'.$request['message_id'].',/',',',$teacher->PM_noread);
            $teacher->save();
//            第3步，修改消息总表
            $message=Message::find($request['message_id']);
            $message->readed=1;
            $message->save();
//            //第四步发送消息
            return redirect()->route('reply_invite_teacher',[session('user'),$team->id,0]);
        }
    }
}
