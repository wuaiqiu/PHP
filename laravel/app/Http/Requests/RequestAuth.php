<?php
//在控制器的request请求改成RequestAuth类型即可
class RequestAuth extends FormRequest{
    
    //权限验证需要为true
    public function authorize(){
        return true;
    }
    
    //验证规则
    public function rules(){
        return [
            'name' => 'required',
            'age' => 'nullable|date',
        ];
    }  
    
}
