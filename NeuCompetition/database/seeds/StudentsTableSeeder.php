<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student=new \App\Student();
        $student->name='李四';
        $student->num='20143810';
        $student->class='1407';
        $student->cardID='532101199603090017';
        $student->email='731918978@qq.com';
        $student->phone_num='18240438908';
        $student->qq_num='731918978';
        $student->major_id='90';
        $student->password=md5('123456');
        $student->save();

        $student=new \App\Student();
        $student->name='李四1';
        $student->num='20143812';
        $student->class='1406';
        $student->cardID='532101199603090018';
        $student->email='731918979@qq.com';
        $student->phone_num='18240438907';
        $student->qq_num='731918979';
        $student->major_id='89';
        $student->password=md5('123456');
        $student->save();

        $student=new \App\Student();
        $student->name='李四2';
        $student->num='20143813';
        $student->class='1405';
        $student->cardID='532101199603090019';
        $student->email='731918980@qq.com';
        $student->phone_num='18240438907';
        $student->qq_num='731918980';
        $student->major_id='88';
        $student->password=md5('123456');
        $student->save();

        $student=new \App\Student();
        $student->name='李四3';
        $student->num='20143814';
        $student->class='1404';
        $student->cardID='532101199603090020';
        $student->email='731918981@qq.com';
        $student->phone_num='18240438906';
        $student->qq_num='731918981';
        $student->major_id='87';
        $student->password=md5('123456');
        $student->save();

        $student=new \App\Student();
        $student->name='李四4';
        $student->num='20143815';
        $student->class='1403';
        $student->cardID='532101199603090021';
        $student->email='731918982@qq.com';
        $student->phone_num='18240438905';
        $student->qq_num='731918982';
        $student->major_id='86';
        $student->save();

        $student=new \App\Student();
        $student->name='李四5';
        $student->num='20143816';
        $student->class='1402';
        $student->cardID='532101199603090022';
        $student->email='731918983@qq.com';
        $student->phone_num='18240438904';
        $student->qq_num='731918983';
        $student->major_id='85';
        $student->password=md5('123456');
        $student->save();

        $student=new \App\Student();
        $student->name='李四6';
        $student->num='20143817';
        $student->class='1401';
        $student->cardID='532101199603090023';
        $student->email='731918984@qq.com';
        $student->phone_num='18240438903';
        $student->qq_num='731918984';
        $student->major_id='84';
        $student->password=md5('123456');
        $student->save();
    }
}
