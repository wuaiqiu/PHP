<?php
/*
 * (1).请求验证；在控制器中验证
 * 
 * $this->validate($request, [
 *          'name' => 'required|unique:posts|max:255',
 *          'age' => 'required',
 * ]);
 * 
 * ---------------------------------------------------
 * 
 * $validator=Validator::make($request->input(),[
 *      'name' => 'required|unique:posts|max:255',
 *      'age' => 'required',
 * ]);
 * 
 * if($validator->fails()){
 *  return redirect()->back()->withErrors($validator);
 * }
 * 
 * 
 * (2).验证规则
 * 
 * bail:首次验证失败后中止后续规则验证
 * nullable:字段可以为null
 * accepted:验证字段的值必须是yes、on、1或true
 * alpha:验证字段必须是字母。
 * alpha_dash:验证字段可以包含字母和数字，以及破折号和下划线。
 * alpha_num:验证字段必须是字母或数字。
 * array:验证字段必须是 PHP 数组。
 * digits_between:min,max:验证字段数值长度必须介于最小值和最大值之间。
 * email：验证字段必须是格式化的电子邮件地址
 * required：验证字段值不能为空，
 * 
 * 
 * (3).错误信息；在前一次请求的一次性session中
 *  
 *  $errors->first('email'):获取某字段的第一条错误信息
 *  $errors->get('email'):获取指定字段的所有错误信息数组
 *  $errors->all():获取所有字段的所有错误信息
 *  $errors->has('email'):判断消息中是否存在某字段的错误信息
 *  $errors->all('<li>:message</li>'):获取指定格式的所有错误信息
 *  
 * (4).自定义错误信息
 * 
 *  $this->validate($request, [
 *          'name' => 'required|unique:posts|max:255',
 *          'age' => 'required',
 * ],[
 *          'required'=>':attribute为必选项',
 *          'max'=>':attrbute不符合要求'
 * ],[
 *          'name'=>'姓名',
 *          'age'=>'年龄'
 * ]);
 * 
 * -------------------------------------------------------
 * 
 * $validator=Validator::make($request->input(),[
 *      'name' => 'required|unique:posts|max:255',
 *      'age' => 'required',
 * ],[
 *          'required'=>':attribute为必选项',
 *          'max'=>':attrbute不符合要求'
 * ],[
 *          'name'=>'姓名',
 *          'age'=>'年龄'
 * ]);
 * 
 * if($validator->fails()){
 *  return redirect()->back()->withErrors($validator);
 * }
 * 
 * */