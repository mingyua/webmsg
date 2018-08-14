<?php

namespace app\manage\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
       'username'  => 'require|unique:user',
       'userpwd'   => 'requireWith:account',


	];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
    	'username.require' => '用户名必须填写',
    	'username.unique' => '用户名已经存在',
    ];
    
    protected $scene = [
         //'edit'  =>  ['username','userpwd'],
    ];
        
}
