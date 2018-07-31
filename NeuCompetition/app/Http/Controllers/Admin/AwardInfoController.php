<?php

namespace App\Http\Controllers\Admin;

use App\Award;
use App\College;
use App\Competition;
use App\Major;
use App\myExcel;
use App\Stu_Com;
use App\Student;
use App\Teacher;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AwardInfoController extends Controller
{
    /**
     * 查询数据
     */
    public function main_page(){
        $colleges=College::all();
        $majors=Major::all();
        return view('info.main_page')->withColleges($colleges)->withMajors($majors);
    }
    public function get_info(Request $request){
        $page=$request['page'];
        if($value=$request['value']){
            if($infos=Award::where('name',$value)->where('year',$request['year'])->orderby('college_id')->get()){
                if($infos->first()){
                }else{
                    if($infos=Award::where('num',$value)->where('year',$request['year'])->orderby('college_id')->get()) {
                        if ($infos->first()) {
                        } else {
                            if ($infos = Award::where('college', $value)->where('year', $request['year'])->orderby('college_id')->get()) {
                                if ($infos->first()) {
                                } else {
                                    if ($infos = Award::where('major', $value)->where('year', $request['year'])->orderby('college_id')->get()) {
                                        if ($infos->first()) {
                                        } else {
                                            if ($infos = Award::where('teacher_name', $value)->where('year', $request['year'])->orderby('college_id')->get()) {
                                                if ($infos->first()) {
                                                }else {
                                                    if ($infos = Award::where('competition_name', $value)->where('year', $request['year'])->orderby('college_id')->get()) {
                                                        if ($infos->first()) {
                                                        } else {
                                                            $infos = array();
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }else{
            if($request['college_id']!='0'){
                if($request['college_id']=='all'){
                    //所有学院，默认所有专业
                    if($request['competition_id']!='0'){
                        //有竞赛限制 --->同无学院限制 无专业限制 仅仅通过比赛ID获取信息
                        //代码直接copy
                        $text=1;
                        $infos=Award::where('competition_id',$request['competition_id'])->where('year',$request['year'])->orderby('college_id')->simplePaginate(50);
                    }
                    else{
                        //无竞赛限制
                        $text=2;
                        $infos=Award::where('year',$request['year'])->orderby('college_id')->simplePaginate(16);
                    }
                }
                else{
                    //个别学院
                    if($request['major_name']=='all'||trim($request['major_name'])=='选择专业'){
                        //所有专业
                        if($request['competition_id']!='0'){
                            //有竞赛限制
                            $text=3;
                            $infos=Award::where('college_id',$request['college_id'])->where('competition_id',$request['competition_id'])->where('year',$request['year'])->orderby('college_id')->simplePaginate(16);
                        }
                        else{
                            //无竞赛限制
                            $text=4;
                            $infos=Award::where('college_id',$request['college_id'])->where('year',$request['year'])->orderby('college_id')->simplePaginate(16);
                        }
                    }else{
                        //个别专业
                        if($request['competition_id']!='0'){
                            //有竞赛限制
                            $text=5;
                            $infos=Award::where('major_id',$request['major_id'])->where('competition_id',$request['competition_id'])->where('year',$request['year'])->orderby('college_id')->simplePaginate(16);
                        }
                        else{
                            //无竞赛限制
                            $text=6;
                            $infos=Award::where('major_id',$request['major_id'])->where('year',$request['year'])->orderby('college_id')->simplePaginate(16);
                        }
                    }
                }
            }else{
                //无学院限制 无专业限制 仅仅通过比赛ID获取信息
                $text=7;
                $infos=Award::where('competition_id',$request['competition_id'])->where('year',$request['year'])->orderby('college_id')->simplePaginate(16);
            }
        }
        //终极决断
        $i=0;
        foreach ($infos as $info) {
//          //空间换时间，增加字段，停止关联查询
            $data[$i]['id']=$info->id;
            $data[$i]['college'] = $info->college;
            $data[$i]['major'] = $info->major;
            $data[$i]['class'] = $info->class;
            $data[$i]['name'] = $info->name;
            $data[$i]['num'] = $info->num;
            $data[$i]['teacher'] = $info->teacher_name;
            $data[$i]['competition_name'] = $info->competition_name;
            $data[$i]['competition_result'] = $info->competition_result;
            $data[$i]['award_info'] = $info->award_info;
            $data[$i]['diploma_url'] = $info->diploma_url;
            $data[$i]['year'] = $info->year;
            $i++;
        }
        if(!$i){
            $data['status']='false';
//            $data['text']=$text;
        }else{
            $data['status']='true';
//            $data['text']=$text;
        }
//        dd($data);
        return response()->json($data);
    }
    public function get_competition(Request $request){
        $data=array();
        if($value=$request['value']){
            if($value=='college'){
                if($colleges=College::all()){
                    $i=0;
                    foreach ($colleges as $college){
                        $data[$i]['id']=$college->id;
                        $data[$i]['name']=$college->college_name;
                        $i++;
                    }
                }else{
                    $data[0]['id']=0;
                    $data[0]['name']=0;
                }
            }else{
                if($majors=Major::all()){
                    $i=0;
                    foreach ($majors as $major){
                        $data[$i]['id']=$major->id;
                        $data[$i]['name']=$major->major_name;
                        $i++;
                    }
                }else{
                    $data[0]['id']=0;
                    $data[0]['name']=0;
                }
            }
        }else{
            if($competitions=Competition::orderBy('created_at')->get()){

                $i=0;
                foreach ($competitions as $competition){
                    $data[$i]['id']=$competition->competition_id;
                    $data[$i]['name']=$competition->name;
                    $i++;
                }
            }else{
                $data[0]['id']=0;
                $data[0]['name']=0;
            }
        }
        return response()->json($data);
    }

    /**
     * 导出excel
     */
    public function export(Request $request) {
        $data_=json_decode($request['data'],true);
        $data=array();
//        dd($data_);
        $number=count($data_)/12;
        for($n=0,$k=0;$n<$number;$n++){
            for($m=0;$m<11;$m++){
                if(!(($k+2)%12)){
                    $k++;
                }
                $data[$n][$m]=$data_[$k++];
            }
        }

        Excel::create('Filename', function($excel) use($data,$number) {
            $excel->sheet('SheetnameLee', function ($sheet) use ($data,$number) {
                //写入首行字段
                $sheet->prependRow(1, array(
                    '序号', '学院', '专业', '班级', '姓名', '学号', '指导老师', '竞赛名称', '竞赛成绩', '获奖信息','年份'
                ));
//              写入数据
                for ($i = 0; $i < count($data); $i++) {
                    $sheet->row($i + 2, $data[$i]);
                }
                $style=array(
                    'A1' => array(
                        'width'     => 8,
                        'height'    => 20
                    ),
                    'B1'=>array(
                        'width'     => 30,
                        'height'    => 20
                    ),
                    'C1'=>array(
                        'width'     => 25,
                        'height'    => 20
                    ),
                    'D1'=>array(
                        'width'     => 8,
                        'height'    => 20
                    ),
                    'E1'=>array(
                        'width'     => 8,
                        'height'    => 20
                    ),
                    'F1'=>array(
                        'width'     => 18,
                        'height'    => 20
                    ),
                    'G1'=>array(
                        'width'     => 12,
                        'height'    => 20
                    ),
                    'H1'=>array(
                        'width'     => 30,
                        'height'    => 20
                    ),
                    'I1'=>array(
                        'width'     => 12,
                        'height'    => 20
                    ),
                    'J1'=>array(
                        'width'     => 12,
                        'height'    => 20
                    ),
                    'K1'=>array(
                        'width'     => 8,
                        'height'    => 20
                    )
                );
                for ($n=2;$n<$number+2;$n++){
                    for ($m='A';$m<='K';$m++){
                        $style[$m.$n]=array(
                            'width'     => $this->style($m),
                            'height'    => 20
                        );
                    }
                }
                //调节大小
                $sheet->setSize($style);
            });
//        })->export('xls');
        })->store('xls');
        $response = array(
            'success' => true,
            'url' => route('download_file')
        );
//        dd($response);
        header('Content-type: application/json');
        echo json_encode($response);
    }
    public function download_file(){
        $file=storage_path().'/exports/Filename.xls';
        return response()->download($file);
    }
    private function style($m){
        switch ($m){
            case 'A':return 8;
            case 'B':return 30;
            case 'C':return 25;
            case 'D':return 8;
            case 'E':return 8;
            case 'F':return 18;
            case 'G':return 12;
            case 'H':return 30;
            case 'I':return 12;
            case 'J':return 12;
            case 'K':return 8;
        }
    }
    public function import_index(){
        return view('info.import_index');
    }

    /**
     * 导入excel
     */
    private $import_all_num=0;
    private $import_success_num=0;
    private $import_failed_num=0;
    public function import(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }
        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        $request->file('file')->move(storage_path().'/files/', 'import.xls');
        $save_path= storage_path().'/files/import.xls';
        /////////////////////////////////////////////////////////
        myExcel::$message=array();
        myExcel::load($save_path, function($reader) {
            //获取excel的第1张表
            $reader = $reader->getSheet(0);
            //获取表中的数据
            $datas = $reader->toArray();
//            $number=count($datas);
            $error=array();
            foreach ($datas as $i=>$data){
                if($i==250) break;
//                session('test',($i/$number*100).'%');
                if($i){
                    $this->import_all_num++;
                    //学生
                    if($student=Student::where('num',$data[5])->first()){
                        $major=$student->major()->first();
//                        dd($major);
                        if($major->major_name==$data[2]||$major->id==$data[2]){
                            $college=$major->college()->first();
                            if($college->college_name==$data[1]||$college->id==$data[1]){
                                if($student->name==$data[4]){
                                    if(Award::where('num',$data[5])->where('competition_name',$data[7])->first()){
                                        $this->import_failed_num++;
                                        $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(6);
                                        continue;
                                    }else{
                                        $map['name']=$data[4];
                                        $map['num']=$data[5];
                                        $map['college']=$college->college_name;
                                        $map['major']=$major->major_name;
                                        $map['college_id']=$college->id;
                                        $map['major_id']=$major->id;
                                        $map['student_id']=$student->id;
                                        $map['class']=$data[3];
                                    }
                                }else{
                                    $this->import_failed_num++;
                                    $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(5);
                                    continue;
                                }
                            }else{
                                $this->import_failed_num++;
                                $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(3);
                                continue;
                            }
                        }else{
                            $this->import_failed_num++;
                            $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(4);
                            continue;
                        }
                    }else{
                        $this->import_failed_num++;
                        $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(1);
                        continue;
                    }
                    //老师
                    if(($teacher=Teacher::where('name',$data[6])->first())||($data[6]=='None')){
                        if($data[6]=='None'){
                            $map['teacher_id']=0;
                        }else{
                            $map['teacher_id']=$teacher->id;
                        }
                        $map['teacher_name']=$data[6];
                    }else{
                        $this->import_failed_num++;
                        $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(2);
                        continue;
                    }
                    //竞赛(竞赛可以不在原来的表中)
                    if(($competition=Competition::where('name',$data[7])->first())||($competition=Competition::find($data[7]))){
                        $map['competition_id']=$competition->competition_id;
                        $map['competition_name']=$competition->name;
                    }else{
                        $map['competition_id']=0;
                        $map['competition_name']=$data[7];
                        //当导入数据库中不存在的数据表时，将会自动写入
                        //由于竞赛数据表不够完善，本功能暂不开启
//                        $com['name']=$data[7];
//                        $competition=Competition::create($com);
//                        if($competition->save()){
//                            $map['competition_id']=$competition->id;
//                        }
                    }
                    //以下内容无需验证
                    $map['competition_result']=$data[8];
                    $map['award_info']=$data[9];
                    $map['year']=$data[10];
                    $map['type']=1;
                    //写入
                    $award=Award::create($map);
                    if($award->save()){
                        $this->import_success_num++;
                    }
                }
            }
            //总结：
            myExcel::$message=array(
                'all'=>$this->import_all_num,
                'success'=>$this->import_success_num,
                'failed'=>$this->import_failed_num,
                'errors'=>$error
            );
        });
        $message=myExcel::$message;
        return view('info.import_summary',$message);
    }
    private function failed_reason($number){
        switch ($number){
            case 1:return '不存在该学生信息，请确定该学生已经注册，或者检查学号是否有误';
            case 2:return '不存在该学生指导老师信息，请确定该老师已经注册，或者检查学生指导老师姓名有误';
            case 3:return '学生信息与学院信息不匹配';
            case 4:return '学生信息与专业信息不匹配';
            case 5:return '学生信息与学号信息不匹配';
            case 6:return '该学生对应的竞赛信息已经存在';
        }
    }
    public function download_model(){
        $file=storage_path().'/import_model/model.xls';
        return response()->download($file);
    }
    public function delete_info(Request $request){
        $datas=$request['data'];
        foreach ($datas as $data){
            Award::find($data)->delete();
        }
        dd($datas);
    }

    /**
     * 写入数据
     */
    public function write_info(Request $request){
//        dd($request['object_id']);

        if(($team=Team::find($request['object_id']))&&$request['type']){
            //团队赛
            $competition=Competition::find($request['competition_id']);
            $teacher=$team->teacher()->first();
            $student=Student::find(-1);//(极度有意思的一句代码，如果不加上这句话，那么下一句代码报错)
            $students=$team->students()->get();
            foreach ($students as $student){
                $major=$student->major()->first();
                $college=$major->college()->first();

                $map['student_id']=$student->id;
                $map['name']=$student->name;
                $map['num']=$student->num;
                $map['college']=$college->college_name;
                $map['college_id']=$college->id;
                $map['major']=$major->major_name;
                $map['major_id']=$major->id;
                $map['class']=$student->class;
                $map['competition_name']=$competition->name;
                $map['competition_id']=$request['competition_id'];
                $map['teacher_name']=$teacher->name;
                $map['teacher_id']=$teacher->id;
                $map['year']=date('Y');
                $map['competition_result']=$request['score'];
                $map['award_info']=$request['grade'];
                $map['type']=0;
                $award=Award::create($map);
                $award->save();
            }
        }
        //个人赛
        if($request['type']){
            $student=Student::where('num',$team->leaderID)->first();
        }else{
            $student=Student::find($request['object_id']);
        }
        $major=$student->major()->first();
        $college=$major->college()->first();
        $competition=Competition::find($request['competition_id']);

        $map['student_id']=$student->id;
        $map['name']=$student->name;
        $map['num']=$student->num;
        $map['college']=$college->college_name;
        $map['college_id']=$college->id;
        $map['major']=$major->major_name;
        $map['major_id']=$major->id;
        $map['class']=$student->class;
        $map['competition_name']=$competition->name;
        $map['competition_id']=$request['competition_id'];
        if($request['type']){
            $teacher=$team->teacher()->first();
            $map['teacher_name']=$teacher->name;
            $map['teacher_id']=$teacher->id;
        }else{
            //个人暂时不添加指导老师
            $map['teacher_name']='None';
            $map['teacher_id']=0;
        }
        $map['year']=date('Y');
        $map['competition_result']=$request['score'];
        $map['award_info']=$request['grade'];
        $map['type']=0;
        $award=Award::create($map);
        $award->save();


        return redirect()->back();
    }
}
