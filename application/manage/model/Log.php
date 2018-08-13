<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2018-2020 The MingYu                                   |
// +----------------------------------------------------------------------+
// | Authors: Original Author <285412937@qq.com>                          |
// |          MingYu <285412937@qq.com>                                   |
// +----------------------------------------------------------------------+
namespace app\manage\model;
use think\Model;
class Log extends Model
{
    
    protected $name = 'log';// 设置当前模型对应的数据表名称
    protected $pk = '';// 设置主键
    protected $createTime = 'addtime';
	protected $updateTime = 'uptime';

}
?>