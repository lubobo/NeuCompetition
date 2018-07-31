@extends('layouts.dashboard')
@section('title')
    奖项设置
@endsection
@section('content')
    <div class="col-xs-12" style="margin-top:10px;">
        {{--<div class="panel-default">--}}
            {{--<h4 class="  text-danger">评审结果</h4>--}}
        {{--</div>--}}
        <table class="table text-center">
            <tr class="bg-teal-active">
                <th class="col-xs-1">学号</th>
                <th class="col-xs-1">姓名</th>
                <th class="col-xs-2">竞赛</th>
                <th class="col-xs-2">评分</th>
                <th class="col-xs-4">备注</th>
                <th class="col-xs-3">奖项</th>
            </tr>
            <?php $k=0;$n=0?>
            @foreach($stu_coms as $stu_com)
                @if($status=='0')
                    <tr class="bg-gray-light">
                        <td class="col-xs-1"><h5 class="">{{$stu_com->stu_num}}</h5></td>
                        <td class="col-xs-1"><h5 class="">{{$stu_com->stu_name}}</h5></td>
                        <td class="col-xs-2"><h5 class="">{{$stu_com->com_name}}</h5></td>
                        <td class="col-xs-2"><h5 class="">{{$stu_com->feedback}}</h5></td>
                        <td class="col-xs-4"><h5 class=" ">{{$stu_com->com_feedback}}</h5></td>
                        <td class="col-xs-3">
                            <h5 class="">
                                <form class="form-group" action="{{route('write_info')}}" method="POST">
                                    <select name="grade" class="form-control">
                                        <option value="一等奖">一等奖</option>
                                        <option value="二等奖">二等奖</option>
                                        <option value="三等奖">三等奖</option>
                                    </select>
                                    <input type="hidden" name="competition_id" value="{{ $com_id }}">
                                    <input type="hidden" name="type" value="{{ $status }}">
                                    <input type="hidden" name="object_id" value="{{ $map[$k]->id }}">
                                    <input type="hidden" name="score" value="{{ $stu_com->feedback}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <p> </p>
                                    <button class="btn btn-xs btn-info" type="submit">确认提交</button>
                                </form>
                            </h5>
                        </td>
                    </tr>
                @endif
                @if($status=='1')
                    <tr class="bg-gray-light">
                        <td class="col-xs-1"><h5 class=" ">{{$stu_com->captain_num}}</h5></td>
                        <td class="col-xs-1"><h5 class=" ">{{$stu_com->captain}}</h5></td>
                        <td class="col-xs-2"><h5 class=" ">{{$stu_com->com_name}}</h5></td>
                        <td class="col-xs-2"><h5 class=" ">{{$stu_com->feedback}}</h5></td>
                        <td class="col-xs-4"><h5 class=" ">{{$stu_com->com_feedback}}</h5></td>
                        <td class="col-xs-3">
                            <h5 class=" ">
                                @if($map1[$n]==null)
                                <form class="form-group" action="{{route('write_info')}}" method="POST">
                                    <select name="grade" class="form-control">
                                        <option value="一等奖">一等奖</option>
                                        <option value="二等奖">二等奖</option>
                                        <option value="三等奖">三等奖</option>
                                    </select>
                                    <input type="hidden" name="competition_id" value="{{ $com_id }}">
                                    <input type="hidden" name="type" value="{{ $status }}">
                                    <input type="hidden" name="object_id" value="{{ $map[$k]->id }}">
                                    <input type="hidden" name="score" value="{{ $stu_com->feedback}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <p> </p>
                                    <button class="btn btn-xs btn-info" type="submit">确认提交</button>
                                </form>
                                @else
                                    <button class="btn btn-xs btn-warning" type="button">
                                        <span class="glyphicon glyphicon-star">  {{$map1[$n]->award_info}}</span>
                                    </button>
                                @endif
                                <?php $n++;?>
                            </h5>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection