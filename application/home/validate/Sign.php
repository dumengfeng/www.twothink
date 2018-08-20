<?php
 
namespace app\home\validate;
use think\Validate; 

class Sign extends Validate{
     
    protected $rule = [
        ['user_id', 'require', '姓名不能为空'],
        ['title', 'require', '标题不能为空'],
        ['content', 'require', '内容不能为空'],
    ];
}