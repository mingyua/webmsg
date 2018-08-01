<?php
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