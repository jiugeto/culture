@extends('company.main')
@section('content')
    <div class="com_firm">
        <div class="title"><div>{{ count($datas)?$datas[0]->name:'' }}</div></div>
        <p>{!! count($datas)?$datas[0]->intro:'' !!}</p>
        <div class="com_recruit_con">
            <table cellspacing="0">
                <tr>
                    <td class="left">职位</td>
                    <td class="second">人数</td>
                    <td>要求</td>
                    <td class="four">更新时间</td>
                </tr>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->small }}</td>
                        <td><div class="admin_show_con">{!! $data->intro !!}</div></td>
                        <td class="four_text">{{ $data->updated_at=='0000-00-00 00:00:00' ? $data->created_at : $data->updated_at }}</td>
                    </tr>
                    @endforeach
                @else @include('member.common.#norecord')
                @endif
            </table>
            <p>
                <b>{{$company?$company->name:'某某公司'}}</b>的邮箱是
                <span style="color:rgb(14,144,210);">{{$company?$company->email:'xxx@xx.com'}}</span>。<br>
                请发简历至<b>{{$company?$company->name:'某某公司'}}</b>邮箱！
            </p>
        </div>
    </div>
@stop