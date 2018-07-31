<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//**********************************************系统主页*********************************************//


Route::get('/', [
    'uses'=>'Admin\CompetitionController@getWelcome',
    'as'=>'welcome'
]);

Route::get('test/{competition_id}/{type}/{object_id}/{score}/{grade}','TestController@index');

Route::get('/admin',[
    'uses'=>'Admin\AdminController@admin_login',
    'as'=>'admin_login'
]);
Route::get('/getHelp',[
    'uses'=>'Home\StudentController@getHelp',
    'as'=>'getHelp'
]);
Route::post('/checkCaptcha',[
    'uses'=>'Home\RegisterController@checkCaptcha',
    'as'=>'checkCaptcha'
]);
//*********************************************竞赛信息部分******************************************//
Route::group(['middleware'=>"login"],function () {
    Route::get('/Competition/{competition_id}', [
        'uses' => 'Admin\CompetitionController@getCompetitions',
        'as' => 'competitions'
    ]);
    Route::get('/Lists', [
        'uses' => 'Admin\CompetitionController@getlists',
        'as' => 'getLists'
    ]);

    Route::get('/OnTime', [
        'uses' => 'Admin\CompetitionController@getOnTimeLists',
        'as' => 'getOnTimeLists'
    ]);
    Route::get('/NoTime', [
        'uses' => 'Admin\CompetitionController@getNoTimeLists',
        'as' => 'getNoTimeLists'
    ]);
    Route::get('/OverTime', [
        'uses' => 'Admin\CompetitionController@getOverTimeLists',
        'as' => 'getOverTimeLists'
    ]);
    Route::post('/Search', [
        'uses' => 'Admin\CompetitionController@postSearch',
        'as' => 'PostSearch'
    ]);

//********************************************Ajax代码部分******************************************//
    Route::post('/checkName',[
        'uses'=>'Admin\CompetitionController@checkName',
        'as'=>'checkName'
    ]);
    Route::post('/checkPlace',[
        'uses'=>'Admin\CompetitionController@checkPlace',
        'as'=>'checkPlace'
    ]);
    Route::post('/checkNum',[
        'uses'=>'Admin\CompetitionController@checkNum',
        'as'=>'checkNum'
    ]);
    Route::post('/checkIntro',[
        'uses'=>'Admin\CompetitionController@checkIntro',
        'as'=>'checkIntro'
    ]);
    Route::post('/finish_submit',[
        'uses'=>'Home\StudentController@finish_submit',
        'as'=>'finish_submit'
    ]);
//*********************************************管理员部分******************************************//
    Route::get('/AdminHome',[
        'uses'=>'Admin\AdminController@getHome',
        'as'=>'adminHome'
    ]);
    Route::get('/AddCompetition', [
        'uses' => 'Admin\AdminController@AddCompetition',
        'as' => 'AddCompetition'
    ]);

    //************************************查看比赛***************************//
    Route::get('/GetCompetition', [
        'uses' => 'Admin\AdminController@GetCompetition',
        'as' => 'GetCompetition'
    ]);
    Route::get('/getAdminLists',[
        'uses' => 'Admin\AdminController@GetCompetition',
        'as' => 'getAdminLists'
    ]);
    Route::get('/getAdminOnTimeLists',[
        'uses' => 'Admin\AdminController@getAdminOnTimeLists',
        'as' => 'getAdminOnTimeLists'
    ]);
    Route::get('/getAdminNoTimeLists',[
        'uses' => 'Admin\AdminController@getAdminNoTimeLists',
        'as' => 'getAdminNoTimeLists'
    ]);
    Route::get('/getAdminOverTimeLists',[
        'uses' => 'Admin\AdminController@getAdminOverTimeLists',
        'as' => 'getAdminOverTimeLists'
    ]);
    Route::get('AdminCompetitions/{competition_id}',[
        'uses'=>'Admin\AdminController@AdminCompetitions',
        'as'=>'AdminCompetitions'
    ]);

    //************************************管理比赛***************************//
    Route::post('/PostCompetition', [
        'uses' => 'Admin\CompetitionController@PostCompetition',
        'as' => 'PostCompetition'
    ]);
    Route::get('/GetDeleteCompetition', [
        'uses' => 'Admin\CompetitionController@getDeleteCompetition',
        'as' => 'getDeleteCompetition'
    ]);
    Route::get('/GetUploadCompetition', [
        'uses' => 'Admin\CompetitionController@getUploadCompetition',
        'as' => 'getUploadCompetition'
    ]);
    Route::post('/UploadCompetition',[
        'uses'=>'Admin\CompetitionController@UploadCompetition',
        'as'=>'UploadCompetition'
    ]);
    Route::get('/getAdminHelp',[
        'uses'=>'Admin\AdminController@getAdminHelp',
        'as'=>'getAdminHelp'
    ]);
    //************************************查看学生***************************//
    Route::get('/AdminStudent',[
        'uses'=>'Admin\AdminController@getAdminStudent',
        'as'=>'getAdminStudent'
    ]);
    Route::get('/Students',[
        'uses'=>'Admin\AdminController@getStudents',
        'as'=>'students'
    ]);
    Route::get('/adminStudent',[
        'uses'=>'Admin\AdminController@adminStudent',
        'as'=>'adminStudent'
    ]);
    Route::post('/delete_student',[
        'uses'=>'Admin\AdminController@delete_student',
        'as'=>'delete_student'
    ]);
    Route::post('change_student',[
        'uses'=>'Admin\AdminController@change_student',
        'as'=>'change_student'
    ]);
    Route::post('/delete_all',[
        'uses'=>'Admin\AdminController@delete_all',
        'as'=>'delete_all'
    ]);
    //************************************查看老师***************************//
    Route::post('/AdminCheck',[
        'uses'=>'Admin\AdminController@adminCheck',
        'as'=>'adminCheck'
    ]);
    Route::get('/TeacherCheck',[
        'uses'=>'Admin\AdminController@getTeachers',
        'as'=>'tea_com'
    ]);
    Route::post('/Tea_Check',[
        'uses'=>'Admin\AdminController@teacherCheck',
        'as'=>'teacherCheck'
    ]);
    Route::post('/time_Check',[
        'uses'=>'Admin\AdminController@timeCheck',
        'as'=>'timeCheck'
    ]);
    Route::get('/adminTeacher',[
        'uses'=>'Admin\AdminController@adminTeacher',
        'as'=>'adminTeacher'
    ]);
    Route::post('/delete_teacher',[
        'uses'=>'Admin\AdminController@delete_teacher',
        'as'=>'delete_teacher'
    ]);
    Route::post('change_teacher',[
        'uses'=>'Admin\AdminController@change_teacher',
        'as'=>'change_teacher'
    ]);
    Route::post('/delete_all_teacher',[
        'uses'=>'Admin\AdminController@delete_all_teacher',
        'as'=>'delete_all_teacher'
    ]);
    //************************************查看团队***************************//
    Route::get('/AdminTeam',[
        'uses'=>'Admin\AdminController@getAdminTeam',
        'as'=>'getAdminTeam'
    ]);
    Route::get('/Teams',[
        'uses'=>'Admin\AdminController@getTeams',
        'as'=>'teams'
    ]);
    Route::get('/TeamCheck',[
        'uses'=>'Admin\AdminController@getTeamCheck',
        'as'=>'teamCheck'
    ]);
    Route::post('/PostTeamCheck',[
        'uses'=>'Admin\AdminController@postTeamCheck',
        'as'=>'postTeamCheck'
    ]);

    //************************************查看奖项***************************//
    Route::get('/getAward',[
        'uses'=>'Admin\AdminController@getAward',
        'as'=>'getAward'
    ]);
    Route::get('/getWardIn',[
        'uses'=>'Admin\AdminController@getAwardIn',
        'as'=>'getAwardIn'
    ]);

//**************************************个人及团队部分************************************//
    Route::get('/SignUp/{com_id}',[
        'uses'=>'Home\StudentController@SignUp',
        'as'=>'SignUp'
    ]);
    Route::get('/Home',[
        'uses'=>'Home\StudentController@getHome',
        'as'=>'myHome'
    ]);
    Route::get('/Submit',[
        'uses'=>'Home\StudentController@getSubmit',
        'as'=>'SubmitData'
    ]);
    Route::post('/PostFile',[
        'uses'=>'Home\StudentController@postFile',
        'as'=>'PostFile'
    ]);
    Route::post('/TeamSignUp',[
        'uses'=>'Home\StudentController@teamSignUp',
        'as'=>'TeamSignUp'
    ]);
//    Route::post('/PostFileAgain',[
//        'uses'=>'Home\StudentController@PostFileAgain',
//        'as'=>'PostFileAgain'
//    ]);
    Route::get('/refresh',[
       'uses'=>'Home\StudentController@refresh',
        'as'=>'refresh'
    ]);
});
//****************************************报名表导出部分********************************//
Route::get('/signUpExport',[
    'uses'=>'Admin\ExcelController@signUpExport',
    'as'=>'signUpExport'
]);
Route::get('teamExport',[
    'uses'=>'Admin\ExcelController@teamExcel',
    'as'=>'teamExcel'
]);

//****************************************教师部分*************************************//
Route::get('/TeacherHome',[
    'uses'=>'Home\TeacherController@teacherHome',
    'as'=>'teacherHome'
]);
Route::get('/Direction',[
    'uses'=>'Home\TeacherController@getDirection',
    'as'=>'getDirection'
]);
Route::get('/getDirectionIn',[
    'uses'=>'Home\TeacherController@getDirectionIn',
    'as'=>'getDirectionIn'
]);
Route::get('/getFile',[
    'uses'=>'Home\TeacherController@getFile',
    'as'=>'getFile'
]);
Route::get('/getReview',[
    'uses'=>'Home\TeacherController@getReview',
    'as'=>'getReview'
]);
Route::get('/getReviewIn',[
    'uses'=>'Home\TeacherController@getReviewIn',
    'as'=>'getReviewIn'
]);
Route::post('/postReviewIn',[
    'uses'=>'Home\TeacherController@postReviewIn',
    'as'=>'postReviewIn'
]);
Route::post('/sendData',[
    'uses'=>'Home\TeacherController@sendData',
    'as'=>'sendData'
]);
Route::post('/backData',[
    'uses'=>'Home\TeacherController@backData',
    'as'=>'backData'
]);

//****************************************注册部分************************************//
Route::group(['prefix'=>"register",'namespace'=>'Home'],function (){
    Route::get('/','RegisterController@index')->name('register');
    Route::get('/{role}','RegisterController@register');
    Route::post('/','RegisterController@register_process');
    Route::post('/get_major','RegisterController@get_major')->name('get_major');
    Route::post('/store','RegisterController@store');
});

//****************************************登陆部分***********************************//
Route::group([],function (){
    Route::get('/login','Home\LoginController@index')->name('login');
    Route::get('/logout','Home\LoginController@logout')->name('logout');
    Route::post('/login_process','Home\LoginController@login')->name('login_process');
    Route::get('kit/captcha/{tmp}', 'Home\KitController@captcha');
    Route::get('/send',[
        'uses'=>'Home\LoginController@sendMail',
        'as'=>'sendMail'
    ]);
    Route::get('/getBack',[
        'uses'=>'Home\LoginController@getBack',
        'as'=>'getBack'
    ]);
});

//****************************************团队部分**********************************//
Route::group(['prefix'=>'team','namespace'=>'Home','middleware'=>'login'],function (){
    //***********************团队创建部分*************************
    Route::get('/list','TeamController@list_')->name('team_list');
    Route::get('/create','TeamController@create')->name('team_create');
    Route::post('/store','TeamController@store')->name('team_store');
    Route::post('/verify','TeamController@verify')->name('team_verify');
    Route::get('/join','TeamController@join')->name('team_join');
    Route::post('/join_process','TeamController@join_process')->name('team_join_process');
    Route::get('/quit/{team_id}','TeamController@team_quit')->name('team_quit');
    Route::get('/dissolved/{team_id}','TeamController@team_dissolved')->name('team_dissolved');
    Route::get('invite_teacher/{teamID}','TeamController@invite_teacher')->name('invite_teacher');
    Route::post('invite_teacher_process','TeamController@invite_teacher_process')->name('invite_teacher_process');
    Route::get('my_team/{role}/{team_id}','TeamController@my_team')->name('my_team');
    Route::get('fire/{student_id}/{team_id}','TeamController@fire')->name('fire');

    //****************************对外接口****************************
    Route::post('search_team','TeamProcessController@search_team')->name('search_team');
});

//*****************************************信息部分*********************************//
//每一条被写入的消息都有自己的处理机制和显示机制
Route::group(['prefix'=>'message','namespace'=>'Home','middleware'=>'login'],function () {
    //******************消息写入****************************//
    Route::get('join_team/{joiner_num}/{team_id}','MessageController@join_team')->name('join_team');
    Route::get('reply_join_team/{joiner_id}/{team_name}/{status}','MessageController@reply_join_team')->name('reply_join_team');
    Route::get('quit_team/{team_name}/','MessageController@quit_team')->name('quit_team');
    Route::get('dissolved_team/{team_id}/{team_name}/{team_count}','MessageController@dissolved_team')->name('dissolved_team');
    Route::post('invite_teacher','MessageController@invite_teacher')->name('invite_teacher_m');
    Route::get('reply_invite_teacher/{teacher_name}/{team_id}/{status}','MessageController@reply_invite_teacher')->name('reply_invite_teacher');
    Route::get('fire/{team_name}/{student_id}','MessageController@fire_team')->name('fire_team');
    //消息接口1:任命指导老师时发送通知消息:
    //teacher_id为老师的id  competition_name为参数的名字
    //调用时请自动修改该方法的重定向
    Route::get('become_competition_rater/{teacher_id}/{competition_name}','MessageController@become_competition_rater')->name('become_competition_rater');
    //消息接口2:管理员的报名消息反馈
    //type为团队报名或者个人报名(team/personal)
    //status:同意报名 1 ;拒绝报名 2
    //competition_name: 竞赛的名字
    //join_id :团队时为team的id 个人时未个人的id
    //调用时请自动修改该方法的重定向
    Route::get('replay_signup/{type}/{status}/{competition_name}/{join_id}','MessageController@replay_signup')->name('replay_signup');
    //******************消息显示****************************//
    Route::get('view_list','MessageViewController@view_list')->name('message_view_list');
    Route::get('personal','MessageViewController@personal')->name('message_personal');
    Route::get('team','MessageViewController@team')->name('message_team');
    Route::get('all','MessageViewController@all')->name('message_all');
    Route::get('join_team_details/{joiner_num}/{team_id}/{messageID?}','MessageViewController@join_team_details')->name('join_team_details');
    Route::get('invite_teacher_details/{team_id}/{messageID?}','MessageViewController@invite_teacher_details')->name('invite_teacher_details');
    //******************消息处理****************************//
    Route::get('message_operate/{message_id}/{type}','MessageProcessController@message_operate')->name('message_operate');
    Route::post('join_team_process','MessageProcessController@join_team_process')->name('join_team_process');
    Route::post('invite_teacher_process_m','MessageProcessController@invite_teacher_process')->name('invite_teacher_process_m');
});

//********************获奖信息查询***************************//
Route::group(['prefix'=>'award_info','namespace'=>'Admin','middleware'=>['login','admin']],function (){
    //获取信息
    Route::get('main_page','AwardInfoController@main_page')->name('info_main_page');
    Route::post('get_competition','AwardInfoController@get_competition')->name('get_competition');
    Route::post('get_info','AwardInfoController@get_info')->name('get_info');
    //导出文件
    Route::post('export','AwardInfoController@export')->name('export');
    Route::get('download_file','AwardInfoController@download_file')->name('download_file');
    //数据导入
    Route::get('import_index','AwardInfoController@import_index')->name('import_index');
    Route::post('import','AwardInfoController@import')->name('import');
    Route::get('download_model','AwardInfoController@download_model')->name('download_model');
    Route::post('delete_info','AwardInfoController@delete_info')->name('delete_info');

    //数据写入
    //competition_id:竞赛表主健
    //type:0->个人赛  1->团队赛
    //object_id: 个人赛->student_id(主健) 团队赛->team_id(主健)
    //score:竞赛得分
    //grade:竞赛获奖 (如一等奖)
    Route::post('write_info','AwardInfoController@write_info')->name("write_info");
});