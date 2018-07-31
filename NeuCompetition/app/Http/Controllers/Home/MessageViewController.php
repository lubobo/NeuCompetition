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

class MessageViewController extends Controller
{
    public function view_list(){
        if(session('role')=='student'){
            $user=Student::where('num',session('num'))->first();
        }
        elseif (session('role')=='teacher'){
            $user=Teacher::where('num',session('num'))->first();
        }
        else{
            $user=Admin::find(session('num'));
        }
        $personal=0;
        $team=0;
        $all=0;
        if($user->PM_noread!=','){
            $personal=1;
        }
        if($user->TM_noread!=','){
            $team=1;
        }
        if($user->AM_noread!=','){
            $all=1;
        }
        return view('message.view_list',[
            'all'=>$all,
            'personal'=>$personal,
            'team'=>$team
        ]);
    }
    public function personal(){
        if(session('role')=='student'){
            $user=Student::where('num',session('num'))->first();
        }
        elseif (session('role')=='teacher'){
            $user=Teacher::where('num',session('num'))->first();
        }
        else{
            $user=Admin::find(session('num'));
        }
        $noread=array();
        $read=array();
        $message_noread_IDs=array();
        $message_read_IDs=array();

        $message_noread=$user->PM_noread;
        if($message_noread!=','){
            $message_noread=$message_noread.'xxx';
            $message_noread_IDs=explode(',',$message_noread,-1);
            foreach ($message_noread_IDs as $message_noread_ID){
                if($message_noread_ID){
                    $noread['m'.$message_noread_ID]=Message::find($message_noread_ID);
                }
            }
        }
        $message_read=$user->PM_read;
        if($message_read!=','){
            $message_read=$user->PM_read.'xxx';
            $message_read_IDs=explode(',',$message_read,-1);
            foreach ($message_read_IDs as $message_read_ID){
                if($message_read_ID){
                    $read['m'.$message_read_ID]=Message::find($message_read_ID);
                }
            }
        }
//        dd($read);
//        dd($noread);
        return view('message.personal')->withReads($read)->withNoreads($noread);
    }

    public function team(){
        if(session('role')=='student'){
            $user=Student::where('num',session('num'))->first();
        }
        elseif (session('role')=='teacher'){
            $user=Teacher::where('num',session('num'))->first();
        }
        else{
            $user=Admin::find(session('num'));
        }
        $noread=array();
        $read=array();
        $message_noread_IDs=array();
        $message_read_IDs=array();

        $message_noread=$user->TM_noread;
        if($message_noread!=','){
            $message_noread=$message_noread.'xxx';
            $message_noread_IDs=explode(',',$message_noread,-1);
            foreach ($message_noread_IDs as $message_noread_ID){
                if($message_noread_ID){
                    $noread['m'.$message_noread_ID]=Message::find($message_noread_ID);
                }
            }
        }
        $message_read=$user->TM_read;
        if($message_read!=','){
            $message_read=$user->TM_read.'xxx';
            $message_read_IDs=explode(',',$message_read,-1);
            foreach ($message_read_IDs as $message_read_ID){
                if($message_read_ID){
                    $read['m'.$message_read_ID]=Message::find($message_read_ID);
                }
            }
        }
//        dd($read);
//        dd($noread);
        return view('message.team')->withReads($read)->withNoreads($noread);
    }
    public function all(){
        if(session('role')=='student'){
            $user=Student::where('num',session('num'))->first();
        }
        elseif (session('role')=='teacher'){
            $user=Teacher::where('num',session('num'))->first();
        }
        else{
            $user=Admin::find(session('num'));
        }
        return view('message.all');
    }

    //****************消息信息显示*********************//
    public function join_team_details($joiner_num,$team_id,$messageID){
        $joiner=Student::where('num',$joiner_num)->first();
//        dd($joiner);
        $data=['team_id'=>$team_id,'joiner'=>$joiner,'messageID'=>$messageID];
        return view('message.join_team_details',$data);
    }
    public function invite_teacher_details($team_id,$message_id){
        $team=Team::where('teamID',$team_id)->first();
        return view('message.invite_teacher_details')->withTeam($team)->withMessage_id($message_id);
    }
}