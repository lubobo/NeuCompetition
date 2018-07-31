<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-7-30
 * Time: 下午5:05
 */

namespace App\Http\Controllers\Home;


use App\Admin;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Latrell\RongCloud\Facades\RongCloud;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }
    public function logout(){
        session(['user'=>null]);
        return redirect()->route('welcome');
    }

    public function login(Request $request){
        if($request['role']=='Teacher'){
            if($teacher=Teacher::where('num',$request['name'])->first()){
                if($teacher->password!=md5($request['password'])) {
                    return redirect()->back()->withInput()->withError('帐号密码输入不正确');
                }
            }
            elseif($teacher=Teacher::where('email',$request['name'])->first()){
                if($teacher->password!=md5($request['password'])) {
                    return redirect()->back()->withInput()->withError('邮箱密码输入不正确');
                }
            }
            else{
                return redirect()->back()->withInput()->withError('暂无帐号信息，请先注册');
            }
        }
        elseif($request['role']=='Student'){
            if($student=Student::where('num',$request['name'])->first()){
                if($student->password!=md5($request['password'])) {
                    return redirect()->back()->withInput()->withError('学号密码输入不正确');
                }
            }
            elseif($student=Student::where('email',$request['name'])->first()){
                if($student->password!=md5($request['password'])) {
                    return redirect()->back()->withInput()->withError('邮箱密码输入不正确');
                }
            }
            else{
                return redirect()->back()->withInput()->withError('暂无帐号信息，请先注册');
            }
        }
        else{
            if($admin=Admin::where('name',$request['name'])->first()){
                if($admin->password!=($request['password'])) {
                    return redirect()->back()->withInput()->withError('管理权限不够，密码输入不正确');
                }
            }
            else{
                return redirect()->back()->withInput()->withError('没有管理权限');
            }
        }

        $userInput = $request['captcha'];
        if (Session::get('milkcaptcha') == $userInput) {
//        if(1){
            //用户输入验证码正确
            if($request['role']=='Teacher'){
                session(['user'=>$teacher->name]);
                session(['role'=>'teacher']);
                session(['num'=>$teacher->num]);
                $url=session('url');
                session(['url'=>null]);
                if($url){
                    return redirect($url);
                }
                else return redirect()->route('welcome');
            }
            elseif($request['role']=='Student'){
                session(['user'=>$student->name]);
                session(['role'=>'student']);
                session(['num'=>$student->num]);
                $url=session('url');
                session(['url'=>null]);
                if($url){
                    return redirect($url);
                }
                else return redirect()->route('welcome');
            }

            else{
                session(['user'=>$admin->name]);
                session(['role'=>'admin']);
                session(['num'=>$admin->id]);
                return redirect()->route('adminHome');
            }

        } else {
            //用户输入验证码错误
            return redirect()->back()->withInput()->withError('验证码输入错误');
        }
    }

//    public function sendMail(){
//        Mail::send ('login.test',['test'=>'有趣'],function ($message){
//            $message->to('731918977@qq.com')->subject('登录验证');
//        });
//    }

    public function getBack(Request $request){
//        $userId = 1;
//        $name = '测试用户';
//        $portrait_uri = 'http://demo.com/1.jpg';
//        $token = RongCloud::getToken($userId, $name, $portrait_uri);
//        logger('RongCloud token: ' . $token);
//        dd($token);
//        $status=RongCloud::userCheckOnline('1');
//        dd($status);

//        return url("https://sms.yunpian.com/v1/sms/send.json")->with([
//            'apikey'=>$request['apikey'],
//            'mobile'=>$request['mobile'],
//            'text'=>$request['text'],
//        ]);

        return view('login.getBack');
    }
}