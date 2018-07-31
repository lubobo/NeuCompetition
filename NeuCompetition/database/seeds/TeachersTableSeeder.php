<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = new \App\Teacher();
        $teacher->name='张三1';
        $teacher->num='20133800';
        $teacher->subject='计算机科学与技术';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_2@163.com';
        $teacher->phone_num='18240448909';
        $teacher->qq_num='731818977';
        $teacher->college_id='16';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三2';
        $teacher->num='20133801';
        $teacher->subject='车辆工程';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_3@163.com';
        $teacher->phone_num='18240448910';
        $teacher->qq_num='731818978';
        $teacher->college_id='4';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三3';
        $teacher->num='20133803';
        $teacher->subject='机械工程';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_4@163.com';
        $teacher->phone_num='18240448911';
        $teacher->qq_num='731818979';
        $teacher->college_id='4';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三4';
        $teacher->num='20133804';
        $teacher->subject='建筑学';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_5@163.com';
        $teacher->phone_num='18240448912';
        $teacher->qq_num='731818980';
        $teacher->college_id='6';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三5';
        $teacher->num='20133805';
        $teacher->subject='工业工程';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_6@163.com';
        $teacher->phone_num='18240448913';
        $teacher->qq_num='731818981';
        $teacher->college_id='8';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三6';
        $teacher->num='20133806';
        $teacher->subject='能源与动力工程';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_7@163.com';
        $teacher->phone_num='18240448914';
        $teacher->qq_num='731818982';
        $teacher->college_id='9';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三7';
        $teacher->num='20133807';
        $teacher->subject='电子科学与技术';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_8@163.com';
        $teacher->phone_num='18240448915';
        $teacher->qq_num='731818983';
        $teacher->college_id='10';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三8';
        $teacher->num='20133808';
        $teacher->subject='自动化类';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_9@163.com';
        $teacher->phone_num='18240448916';
        $teacher->qq_num='731818984';
        $teacher->college_id='10';
        $teacher->password=md5('123456');
        $teacher->save();

        $teacher = new \App\Teacher();
        $teacher->name='张三9';
        $teacher->num='20133809';
        $teacher->subject='英语';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_0@163.com';
        $teacher->phone_num='18240448917';
        $teacher->qq_num='731818985';
        $teacher->college_id='13';
        $teacher->password=md5('123456');
        $teacher->save();
    }
}
