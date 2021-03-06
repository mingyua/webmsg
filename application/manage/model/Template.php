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
class Template extends Model
{
    
    protected $name = 'template';// 设置当前模型对应的数据表名称
    protected $pk = 'id';// 设置主键

    public function cate()
    {
        return $this->belongsTo('Cate','id');
    }
}
?>