<?php
/*
 * 1.模板继承
 * 
 * layout.blade.php
 * ---------------------------------------
 * <p>@yield('footer','这是父模板footer')</p>
 * 
 * <p>
 * @section('content')
 * 这是父模板content
 * @show
 * </p>
 * ---------------------------------------
 * 
 * 
 * index.blade.php
 * ---------------------------------------
 * @extends('layout')
 * 
 * @section('footer', '这是子模板footer')
 * 
 * @section('content')
 * @parent
 *  这是子模板content
 * @endsection
 * ---------------------------------------
 * 
 * 
 * 2.组件
 * 
 * alert.blade.php
 * ---------------------------------------
 * <p>{{$slot}}</p>
 * 
 * <p>
 *   <span>{{$title}}</span>
 *   {{slot}}
 * </p>
 * 
 * <p>{{$slot}}{{$name}}</p>
 * ---------------------------------------
 * 
 * 
 * index.blade.php
 * ---------------------------------------
 * @component('alert')
 *   Hello world
 * @endcomponent
 * 
 * @component('alert')
 *  @slot('title')
 *      PHP
 *  @endslot
 *  Hello world
 * @endcomponent
 * 
 * @component('alert',['name'=>'zhangsan'])
 *   Hello world
 * @endcomponent
 * ---------------------------------------
 * 
 * 
 * 3.数据显示
 * 
 * #输出存在的数据
 * {{ isset($name) ? $name : 'Default' }}
 * {{ $name or 'Default' }}
 * 
 * #保持原样
 * @{{ $name }}
 * 
 * @verbatim
 *    {{$name}}
 * @endverbatim
 * 
 * 
 * 
 * 4.流程控制
 *   
 *  (1).条件语句
 *    @if (true)
 *          ....
 *    @elseif (true)
 *          ....
 *    @else
 *          ....
 *    @end
 *    
 *  (2).循环语句
 *    @for ($i = 0; $i < 10; $i++)
 *         ....
 *    @endfor
 *    
 *    @foreach ($users as $user)
 *         ....
 *    @endforeach
 *    
 *    @while (true)
 *         ....
 *    @endwhile
 *    
 *   (3).@continue与 @break
 *   
 *   (4).$loop循环体中使用
 *      $loop->index	当前循环迭代索引 (从0开始)
 *      $loop->count	迭代数组元素的总数量
 *      $loop->first	是否是当前循环的第一个迭代
 *      $loop->last	    是否是当前循环的最后一个迭代
 *   
 * 
 * 5.注释
 *  {{--注释--}}
 *  
 *  
 * 6.包含子视图
 *   @include('viewName', ['some' => 'data'])
 *  
 * */