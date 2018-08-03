<?php
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