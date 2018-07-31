<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-7-29
 * Time: 下午12:41
 */

namespace App\Http\Controllers\Home;


use App\College;
use App\Http\Controllers\Controller;
use App\Major;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Latrell\RongCloud\Facades\RongCloud;
use App\Competition;
use Symfony\Component\HttpFoundation\Session\Session;

//查询接口
class nowapi{
    //配置  需修改API_APPKEY及API_SECRET，获取您自己的APPKEY及SECRET需去官网注册并免费开通相应接口
    const API_URL='http://api.k780.com:88';
    const API_APPKEY='10003';
    const API_SECRET='d1149a30182aa2088ef645309ea193bf';

    //错误容器
    private static $nowapi_error='';

    /*
     * API请求主函数
     * @a_parm
     *   $a_parm=array(
            'app'=>'接口代号',
            'format'=>'数据格式 json/base64',
            'c_timeout'=>'连接API超时时间',
        )
     * @return 错误:false 成功:结果集数组
     */
    public static function callapi($a_parm){
        //判断
        if(empty($a_parm['app'])){
            self::$nowapi_error='Parameter reqno nust be present';
            return false;
        }
        if(!empty($a_parm['format']) && !in_array($a_parm['format'],array('json','base64'))){
            self::$nowapi_error='Parameter format error';
            return false;
        }
        //参数组合$a_post
        foreach($a_parm as $key=>$val){
            $a_post[$key]=$val;
        }
        unset($a_parm);
        //预处理
        if(empty($a_post['appkey'])){
            $a_post['appkey']=self::API_APPKEY;
        }
        if(empty($a_post['secret'])){
            $a_post['secret']=self::API_SECRET;
        }
        if(empty($a_post['format'])){
            $a_post['format']='base64';
        }
        $a_post['sign']=md5(md5($a_post['appkey']).$a_post['secret']);
        $c_timeout=!empty($a_post['c_timeout'])?$a_post['c_timeout']:60;
        unset($a_post['c_timeout']);
        unset($a_post['secret']);

        //CURL
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,self::API_URL."/index.php");
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$a_post);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_TIMEOUT,$c_timeout);
        if(!$result=curl_exec($curl)){
            self::$nowapi_error=curl_error($curl);
            curl_close($curl);
            return false;
        }
        curl_close($curl);
        //结果集处理
        if($a_post['format']=='base64'){
            $a_api=unserialize(base64_decode($result));
        }else{
            if(!$a_api=json_decode($result,true)){
                self::$nowapi_error='remote api not json decode';
                return false;
            }
        }
        if($a_api['success']!='1'){
            self::$nowapi_error=$a_api['msg'];
            return false;
        }
        return $a_api['result'];
    }

    /*捕捉错误*/
    public static function error(){
        if(empty(self::$nowapi_error)){
            return true;
        }
        return self::$nowapi_error;
    }
}

class RegisterController extends Controller
{
    public function index(){
        return view('login.select');
    }
    public function register($role){
        $colleges=College::all();
        $majors=Major::where('college_id',1)->get();
        if($role=="teacher"){
            return view('login.register_teacher')->withColleges($colleges);
        }
        else
            return view('login.register_student')->withColleges($colleges)->withMajors($majors);
    }
    public function register_process(Request $request){
        if($request['field']=='name'){
            if (strlen($request['name'])==0){
                echo 'name is must';
            }
            else{
                echo 'right';
            }
        }   //名字
        elseif ($request['field']=='email'){
            if(!preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',$request['value'])){
                echo 'form is wrong';
            }
            else echo 'right';
        }  //邮箱
        elseif ($request['field']=='phone_num'){
            $a_parm=array(
                'app'=>'phone.get',
                'phone'=>$request['value'],
//                'phone'=>'15702417763',
            );
            if(!$result=nowapi::callapi($a_parm)){
                echo 'form is wrong';
//                        echo nowapi::error();
            }
            header('Content-Type: text/html; charset=utf-8;');
            if($result['status']=='NOT_ATT'){
                echo 'form is wrong';
            }
            else{
                echo $result['operators'].' '.'('.$result['att'].')';
            }
        }  //手机号
        else{
            if($request['role']=='teacher'){
                if ($request['field']=='num'){
                    if (strlen($request['value'])==0){
                        echo 'std_num is must';
                    }
                    elseif(Teacher::where('num',$request['value'])->first()) {
                        echo 'has registered';
                    }
                    else{
                        echo 'right';
                    }
                }   //老师-工资号
            }
            else{

                if ($request['field']=='num'){
                    if (strlen($request['value'])==0){
                        echo 'std_num is must';
                    }
                    elseif(Student::where('num',$request['value'])->first()) {
                        echo 'has registered';
                    }
                    else{
                        echo 'right';
                    }
                }   //学生-学号
                elseif ($request['field']=='class'){
                    if (strlen($request['value'])==0){
                        echo 'class is must';
                    }

                    else{
                        echo 'right';
                    }
                }   //学生-班级
                elseif ($request['field']=='cardID'){
//                    if (!$this->carID_verify($request['value'])){
//                        $d["status"]='cardID is wrong';
//                    }
//                    else{
//                        $year=substr($request['value'],6,4);
//                        $month=substr($request['value'],10,2);
//                        if($month<=12&&$month>0&&$year<2020&&$year>1949){
//                            $d['year']=$year;
//                            $d['month']=$month;
//                            $d["status"]='right';
//                        }
//                        else{
//                            $d["status"]='cardID is wrong';
//                        }
//                    }
                    //其它接口根据文档修改其参数即可调用
                    $a_parm=array(
                        'app'=>'idcard.get',
                        'idcard'=>$request['value'],
                    );
                    if(!$result=nowapi::callapi($a_parm)){
                        $d["status"]='cardID is wrong';
//                        echo nowapi::error();
                    }
                    header('Content-Type: text/html; charset=utf-8;');
                    if(!$result["status"]){
                        $d["status"]='cardID is wrong';
                    }else{
                        $d['born']=$result["born"];
                        $d["att"]=$result['att'];
                        $d['sex']=$result['sex'];
                        $d["status"]='right';
                    }
//                    $m=array(
//                        'status'=>'123'
//                    );
                    return response()->json($d);
                }   //身份证号
            }
        }
    }
    public function carID_verify($id){
        if (strlen($id)!=18){
            return 0;
        }
        $a=str_split($id,1);
        $w=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
        $c=array(1,0,'X',9,8,7,6,5,4,3,2);
        $sum=0;
        for ($i=0;$i<17;$i++){
            $sum=$sum+$a[$i]*$w[$i];
        }
        $r=$sum%11;
        $rec=$c[$r];
        if ($rec==$a[17]){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function get_major(Request $request){
        $college=$request['college'];
//        $college='软件学院';
        $major=College::where('college_name',$college)->first()->majors()->get();
        global $m;
        $i=0;
//        $m[0]=$major->first()->major_name;
        foreach ($major as $row){
            $m[$i]=$row['major_name'];
            $i++;
        }

        return response()->json($m);
    }
    public function store(Request $request){
        $map=$request->except(['_token','role','college','major_name',]);
        $map['password']=md5($request['password']);
        $userId=$map['num'];
        $name=$map['name'];
        $portraitUri='http://202.118.31.197/ACTIONDSPUSERPHOTO.APPPROCESS';
        $token=RongCloud::getToken($userId,$name,$portraitUri);
//        dd($token['token']);
        if($request['role']=='student'){
            $major=$request['major_name'];
            $major_id=Major::where('major_name',$major)->first()->id;
            $map['major_id']=$major_id;
            $map['api_token']=$token['token'];
            $student=Student::create($map);
            if($student->save()){
                return redirect()->route('login');
            }
        }
        else{
            $college=$request['college'];
            $college_id=College::where('college_name',$college)->first()->id;
            $map['college_id']=$college_id;
            $map['api_token']=$token['token'];
            $teacher=Teacher::create($map);
            if($teacher->save()) {
                return redirect()->route('login');
            }
        }
    }


}