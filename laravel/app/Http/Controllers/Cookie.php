<?php
/*
 * Cookie
 * 
 * $value = $request->cookie('name'):获取cookie
 * $cookie=cookie('name', 'value', $minutes)：生成cookie,有效期（分钟）
 * return response('保存成功')->cookie($cookie)：发送cookie
 * 
 * 
 * Session(Request Session,session(),Session)
 * 
 * Session::put('key3','value3'):
 * Session::put(['key4'=>'value4','key5'=>'value5']):
 * Session::get('key3'):
 * Session::get('key4','未知'):
 * Session::all():获取所用session
 * Session::push('students','eason'):推送数据到数组
 * Session::pull('students','eason'):获取并删除数据
 * Session::has('key1'):
 * Session::forget('key1'):删除数据
 * Session::flush():全部清空
 * Session::flash('key6','value6'):一次性数据
 * Session::regenerate():重新生成Session ID
 * */