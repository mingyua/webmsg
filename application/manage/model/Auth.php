<?php

namespace app\manage\model;

use think\Model;

class Auth extends Model
{
    
    protected $name = 'auth';// 设置当前模型对应的数据表名称
    protected $pk = 'menuid';// 设置主键

    public function menu()
    {
        return $this->belongsTo('Menu','menuid');
    }      
}
