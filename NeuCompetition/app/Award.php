<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

/**
 * App\Award
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $num
 * @property string $class
 * @property \App\Major $major
 * @property \App\College $college
 * @property string $teacher_name
 * @property string $competition_name
 * @property integer $college_id
 * @property integer $major_id
 * @property integer $student_id
 * @property integer $teacher_id
 * @property integer $competition_id
 * @property integer $year
 * @property string $competition_result
 * @property string $award_info
 * @property string $diploma_url
 * @property integer $type 0:写入的数据 1：导入的数据
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Student $student
 * @property-read \App\Competition $competition
 * @property-read \App\Teacher $teacher
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereMajor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereCollege($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereTeacherName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereCompetitionName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereCollegeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereMajorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereCompetitionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereCompetitionResult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereAwardInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereDiplomaUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Award whereUpdatedAt($value)
 */

class Award extends Model
{
    protected $guarded=[];

    static public $test;

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function college(){
        return $this->belongsTo('App\College');
    }
    public function major(){
        return $this->belongsTo('App\Major');
    }
    public function competition(){
        return $this->belongsTo('App\Competition');
    }
    public function teacher(){
        return $this->belongsTo('App\Teacher');
    }


    public function import($filePath) {
        Excel::load($filePath, function($reader) {
            //获取excel的第1张表
            $reader = $reader->getSheet(0);
            //获取表中的数据
            $dates = $reader->toArray();
            $error=array();
//            dd($dates);
            foreach ($dates as $i=>$date){
                if($i){
                    $this->import_all_num++;
                    //学生
                    if($student=Student::where('num',$date[5])->first()){
                        $major=$student->major()->first();
//                        dd($major);
                        if($major->major_name==$date[2]||$major->id==$date[2]){
                            $college=$major->college()->first();
                            if($college->college_name==$date[1]||$college->id==$date[1]){
                                if($student->name==$date[4]){
                                    $map['name']=$date[4];
                                    $map['num']=$date[5];
                                    $map['college']=$date[1];
                                    $map['major']=$date[2];
                                    $map['college_id']=$college->id;
                                    $map['major_id']=$major->id;
                                    $map['student_id']=$student->id;
                                    $map['class']=$date[3];
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
                    if(($teacher=Teacher::where('name',$date[6])->first())||($date[6]=='None')){
                        if($date[6]=='None'){
                            $map['teacher_id']=0;
                        }else{
                            $map['teacher_id']=$teacher->id;
                        }
                        $map['teacher_name']=$date[6];
                    }else{
                        $this->import_failed_num++;
                        $error[$i-1]='有误信息序号'.$i.':'.$this->failed_reason(2);
                        continue;
                    }
                    //竞赛(竞赛可以不在原来的表中)
                    if(($competition=Competition::where('name',$date[7])->first())||($competition=Competition::find($date[7]))){
                        $map['competition_name']=$date[7];
                        $map['competition_id']=$competition->competition_id;
                    }else{
                        $map['competition_name']=$date[7];
                        $map['competition_id']=0;
                    }
                    //以下内容无需验证
                    $map['competition_result']=$date[8];
                    $map['award_info']=$date[9];
                    $map['year']=$date[10];
                    $map['type']=1;
                    //写入
//                    $award=Award::create($map);
//                    if($award->save()){
//                        $this->import_success_num++;
//                    }
                    $this->import_success_num++;
                }
            }
            //总结：
            $message=array(
                'all'=>$this->import_all_num,
                'success'=>$this->import_success_num,
                'failed'=>$this->import_failed_num,
                'errors'=>$error
            );
            return $message;
//            dd($message);
        });
//        return redirect()->route('import_summary');
    }



}
