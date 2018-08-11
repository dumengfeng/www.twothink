<?php
 
namespace app\admin\validate;
use think\Validate; 

class Repair extends Validate{
     
    protected $rule = [ 
        ['username', 'require', '姓名不能为空'],
        ['title', 'require', '标题不能为空'],
        ['address', 'require', '地址不能为空'],
        ['phone', 'require', '电话不能为空'],
        ['content', 'require', '内容不能为空'],
    ];   
}