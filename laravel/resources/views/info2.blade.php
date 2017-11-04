@extends('layout')

@section('content')
	@parent
	<br/>
	这是子模板content
@stop

@section('footer')
这是子模板footer
<br/>
{{--输出变量 --}}
<p>我是{{$name}}</p>
{{--调用php代码--}}
<p>{{Date('Y-m-s H:i:s')}}</p>
{{--原样输出--}}
<p>@{{$name}}</p>
{{--包含文件--}}
@include('include',['message'=>'包含文件'])
@stop
