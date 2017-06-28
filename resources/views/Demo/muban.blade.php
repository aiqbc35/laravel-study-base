@extends('layouts')

@section('header')
    @parent
header
@stop

@section('content')
    @parent
    {{--流程控制--}}
    @if ($name == 'xiaobai')
        yes
    @elseif ($name == 'xiaohei')
        xiaohei
    @else
        default
    @endif

    <br>
    @if (in_array($name,$info))
        yes
    @else
        no
    @endif

    <br>
    {{--跟if 相反,比如下面这个判断，如果是if那么是成立的，但是unless则相反--}}
    @unless($name == 'xiaobai')
        yes
    @endunless

    <br>
    @for($i=0;$i<3;$i++)
        <p>{{$i}}</p>
    @endfor

    <br>
    @foreach($list as $v)
        <p>{{$v->name}}</p>
    @endforeach

    @forelse($list as $v)
        <p>{{$v->name}}</p>
    @empty
        <p>如果$list为空的话则显示这里</p>
    @endforelse
@stop