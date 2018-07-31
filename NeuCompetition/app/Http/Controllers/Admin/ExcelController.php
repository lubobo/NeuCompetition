<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Stu_Com;
use App\TeamCompetition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;

class ExcelController extends Controller
{
    public function signUpExport(Request $request){
        $grade=Competition::where(['name'=>$request['com_name']])->value('grade');
        if (session('user')=='root') {
            $stu_coms = Stu_Com::where(['com_name' => $request['com_name'], 'stu_status' => '2'])->get();
        }
        else if($grade=='0') {
            $stu_coms = Stu_Com::where(['com_name' => $request['com_name'], 'stu_status' => '1'])->get();
        }else
            $stu_coms = Stu_Com::where(['com_name' => $request['com_name'], 'stu_status' => '2'])->get();
        $m=1;
        $cellData=array(array());
        $cellData[0]=['编号','姓名','学号','学院','专业','备注'];
        foreach ($stu_coms as $stu_com){
            $cellData[$m++]=[$m++,$stu_com->stu_name, $stu_com->stu_num, $stu_com->stu_colleges, $stu_com->stu_major, '审核通过'];
        }
        Excel::create($request['com_name'].'报名信息表',function($excel)use($cellData){
            $excel->sheet('score', function($sheet) use ($cellData) {
                $sheet->rows($cellData);
                $sheet->setWidth(array(
                    'A'     =>  15,
                    'B'     =>  15,
                    'C'     =>  20,
                    'D'     =>  25,
                    'E'     =>  25,
                    'F'     =>  20
                ));
                $sheet->cells('A:E',function($cells){
                    $cells->setAlignment('center');
                });
            });
        })->export('xls');
    }

    public function teamExcel(Request $request){
        $grade=Competition::where(['name'=>$request['com_name']])->value('grade');
        if (session('user')=='admin') {
            $team_coms = TeamCompetition::where(['com_name' => $request['com_name'], 'team_status' => '2'])->get();
        }
        else if($grade=='0') {
            $team_coms = TeamCompetition::where(['com_name' => $request['com_name'], 'team_status' => '1'])->get();
        } else
            $team_coms = TeamCompetition::where(['com_name' => $request['com_name'], 'team_status' => '2'])->get();
        $m=1;
        $cellData=array(array());
        $cellData[0]=['编号','团队名称','队长','学号','学院','专业','备注'];
        foreach ($team_coms as $team_com){
            $cellData[$m++]=[$m++,$team_com->team_name,$team_com->captain,$team_com->captain_num,$team_com->college,$team_com->major,'审核通过'];
        }
        Excel::create($request['com_name'].'报名信息表',function($excel)use($cellData){
            $excel->sheet('score', function($sheet) use ($cellData) {
                $sheet->rows($cellData);
                $sheet->setWidth(array(
                    'A'     =>  15,
                    'B'     =>  20,
                    'C'     =>  20,
                    'D'     =>  20,
                    'E'     =>  25,
                    'F'     =>  25,
                    'G'     =>  20
                ));
                $sheet->cells('A:E',function($cells){
                    $cells->setAlignment('center');
                });
            });
        })->export('xls');
    }
}
