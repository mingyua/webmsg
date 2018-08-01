<?php
namespace app\manage\model;
use think\Model;
class Article extends Model
{
    
    protected $name = 'article';// 设置当前模型对应的数据表名称
    protected $pk = 'id';// 设置主键
    protected $createTime = 'addtime';
	protected $updateTime = 'uptime';

    public function cate()
    {
        return $this->belongsTo('Cate','cateid');
    }
}
?>