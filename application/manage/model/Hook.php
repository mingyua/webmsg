<?php

namespace app\manage\model;

use think\Model;

class Hook extends Model
{
        
    protected $name = 'hook';// 设置当前模型对应的数据表名称
    protected $pk = 'id';// 设置主键
    protected $createTime = 'addtime';
	protected $updateTime = 'uptime';

}
