<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use App\TeamCompetition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competition;
use Illuminate\Support\Facades\Auth;
use Latrell\RongCloud\Facades\RongCloud;
use Storage;
use App\Stu_Com;
use App\Tea_Com;
use App\College;


class CompetitionController extends Controller
{

    public function getWelcome(){
        $competitions=Competition::orderBy('created_at','asc')->paginate(12);
        return view('competition.welcome',['competitions'=>$competitions]);
    }

    public function getCompetitions($competition_id){
        $stu1=Stu_Com::where(['stu_name'=>session()->get('user'),'com_id'=>$competition_id])->first();
        if(!$stu1){
            {session()->put('old','0');}
        }
        else{
            {session()->put('old','1');}
        }
        $competition=Competition::where('competition_id',$competition_id)->first();
        $tea_com=Tea_Com::where('com_name',$competition->name)->first();
        if ($competition->status=='1'){
            $team=TeamCompetition::where(['captain'=>session()->get('user'),'com_name'=>$competition->name])->first();
            if(!$team){
                {session()->put('old','0');}
            }
            else{
                {session()->put('old','2');}
            }
        }
//        $status=RongCloud::usercheckOnline(session('num'));
//        dd($status);
//        RongCloud::smsGetImgCode();
        return view('competition.getCompetition',['competition'=>$competition,'tea_com'=>$tea_com,'com_name'=>$competition->name]);
    }
    public function getLists(){
        $competitions=Competition::orderBy('start_time','desc')->paginate(20);
        return view('competition.getLists',['competitions'=>$competitions]);
    }
    public function getOnTimeLists(){
        $competitions=Competition::orderBy('start_time','asc')->paginate(20);
        return view('competition.getOnTimeLists',['competitions'=>$competitions]);
    }
    public function getNoTimeLists(){
        $competitions=Competition::orderBy('start_time','asc')->paginate(20);
        return view('competition.getNoTimeLists',['competitions'=>$competitions]);
    }
    public function getOverTimeLists(){
        $competitions=Competition::orderBy('start_time','asc')->paginate(20);
        return view('competition.getOverTimeLists',['competitions'=>$competitions]);
    }

    public function postSearch(Request $request){
//        dd($request['post_name']);
        $competition=Competition::where('name',$request['post_name'])->first();
        return view('competition.getCompetition',['competition'=>$competition]);
    }
//*******************************************Ajax处理脚本****************************************//
    public function checkName(Request $request){
        $check = Competition::where(['name' => $request['name']])->value('name');
        if (isset($check)) {
            return '标题已经存在';
        }
        elseif (empty($request['name'])){
            return '标题不能为空';
        }
        else
            return ' ';
    }

    public function checkPlace(Request $request){
        if (empty($request['place'])){
            return '举办地不能为空';
        }
        else
            return ' ';
    }

    public function checkNum(Request $request){
        if (empty($request['num'])){
            return '竞赛人数不能为空';
        }
        else
            return ' ';
    }
    public function checkIntro(Request $request){
        $intro=Competition::where(['intro'=>$request['intro']])->value('intro');
        if (isset($intro)) {
            return '该竞赛已经存在';
        }
        elseif (empty($intro)){
            return '竞赛简介不能为空';
        }
        else
            return ' ';
    }

    public function PostCompetition(Request $request){
        $this->validate($request,[
            'com_name'=>'required|unique:competitions,name|min:2',
            'com_place'=>'required|min:2',
            'com_organizer'=>'required|min:2',
            'com_time'=>'required|date',
            'start_time'=>'required|date',
            'end_time'=>'required|date',
            'com_intro'=>'required|unique:competitions,intro|max:10000',
            'com_status'=>'required',
            'student_num'=>'required'
        ]);
        $competition=new Competition();
        $competition->name=$request['com_name'];
        $competition->grade=$request['com_grade'];
        $competition->place=$request['com_place'];
        $competition->organizer=$request['com_organizer'];
        $competition->com_time=$request['com_time'];
        $competition->start_time=$request['start_time'];
        $competition->end_time=$request['end_time'];
        $competition->intro=$request['com_intro'];
        $competition->status=$request['com_status'];
        $competition->student_num=$request['student_num'];
        $competition->save();

        $file = $request->file('com_file');
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        $com=Competition::where('name',$request['com_name'])->value('competition_id');
        $newFileName =$com.'.'.$file->getClientOriginalExtension();
        $savePath ='/competition/'.'pics/'.$newFileName;
        Storage::put(
            $savePath,
            file_get_contents($file->getRealPath())
        );
        if(!Storage::exists($savePath)){
            exit('保存文件失败！');
        }
        return redirect()->route('GetCompetition');
    }

    public function getDeleteCompetition(Request $request){
        $competition=Competition::where('competition_id',$request['competition_id'])->first();
        $com=Competition::where('competition_id',$request['competition_id'])->value('competition_id');
        $filePath = '/competition/'.'pics/'.$com.'.jpg';
        Storage::delete($filePath);
        $competition->delete();
        return redirect()->route('GetCompetition');
    }

    public function getUploadCompetition(Request $request){
        $competition=Competition::find($request['competition_id']);
        $colleges=College::orderBy('id','asc')->get();
        $com=$request['competition_id'];
        return view('admin.UploadCompetition',
            [
                'competitions'=>$competition,
                'com'=>$com,
                'colleges'=>$colleges
            ]
        );
    }
    
    public function UploadCompetition(Request $request){
        $this->validate($request,[
            'com_name'=>'required|min:2',
            'com_place'=>'required|min:2',
            'com_organizer'=>'required|min:2',
            'com_time'=>'required|date',
            'start_time'=>'required|date',
            'end_time'=>'required|date',
            'com_intro'=>'required|max:10000',
            'com_status'=>'required',
            'student_num'=>'required'
        ]);


        $competition=Competition::where('competition_id',$request['competition_id'])->update([
            'name'=>$request['com_name'],
            'grade'=>$request['com_grade'],
            'place'=>$request['com_place'],
            'organizer'=>$request['com_organizer'],
            'com_time'=>$request['com_time'],
            'start_time'=>$request['start_time'],
            'end_time'=>$request['end_time'],
            'intro'=>$request['com_intro'],
            'competition_id'=>$request['competition_id'],
            'status'=>$request['com_status'],
            'student_num'=>$request['student_num'],
        ]);
        if ($request->file('com_file')) {
            $file = $request->file('com_file');
            if (!$file->isValid()) {
                return redirect()->route('GetCompetition');
//            exit('文件上传出错！');
            }
            $com = Competition::where('name', $request['com_name'])->value('competition_id');
            $newFileName = $com . '.' . $file->getClientOriginalExtension();
            $savePath = '/competition/' . 'pics/' . $newFileName;
            Storage::put(
                $savePath,
                file_get_contents($file->getRealPath())
            );
            if (!Storage::exists($savePath)) {
                exit('保存文件失败！');
            }
            return redirect()->route('GetCompetition');
        }
        else
            return redirect()->route('GetCompetition');
    }
    
}