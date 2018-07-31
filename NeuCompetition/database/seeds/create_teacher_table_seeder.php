<?php

use Illuminate\Database\Seeder;

class create_teacher_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher=new \App\Teacher();
        $teacher->name='huge god';
        $teacher->num='123456';
        $teacher->subject='计算机科学与技术';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_1@163.com';
        $teacher->phone_num='18240438909';
        $teacher->qq_num='731918977';
        $teacher->college_id='16';
        $teacher->password='123456789';
        $teacher->save();

        $teacher=new \App\Teacher();
        $teacher->name='huge god1';
        $teacher->num='123457';
        $teacher->subject='计算机科学与技术';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_2@163.com';
        $teacher->phone_num='18240438908';
        $teacher->qq_num='731918976';
        $teacher->college_id='16';
        $teacher->password='123456789';
        $teacher->save();

        $teacher=new \App\Teacher();
        $teacher->name='huge god2';
        $teacher->num='123458';
        $teacher->subject='计算机科学与技术';
        $teacher->job='教师';
        $teacher->job_title='教授';
        $teacher->email='m18240438909_3@163.com';
        $teacher->phone_num='18240438905';
        $teacher->qq_num='731918975';
        $teacher->college_id='16';
        $teacher->password='123456789';
        $teacher->save();
    }
}
