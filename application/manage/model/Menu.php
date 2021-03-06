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
class Menu extends Model
{
    
    protected $name = 'menu';// 设置当前模型对应的数据表名称
    protected $pk = 'id';// 设置主键
	protected $autoWriteTimestamp = false;
    public function auth()
    {
        return $this->belongsTo('Auth','id');
    }      
	

}
?>