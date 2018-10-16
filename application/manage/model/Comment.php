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
use think\Db;
class Comment extends Model
{
    
    protected $name = 'comment';// 设置当前模型对应的数据表名称
    protected $pk = 'id';// 设置主键
    protected $createTime = 'addtime';
	protected $updateTime = 'uptime';

    public function commentcate()
    {
        return $this->belongsTo('Commentcate','cateid');
    }
    public function user()
    {
        return $this->belongsTo('User','uid');
    }
    public function pagelist($where,$order,$frist,$end)
    {
    	$data=db('comment')->alias('A')->join('user D','A.uid=D.id')->join('comment_cate C','A.cateid=C.id')->field('A.*,C.name as catename,FROM_UNIXTIME(A.addtime,"%Y/%d/%m %H:%i:%s") as time,D.username,D.thumb,(SELECT count(comment_id) FROM wb_comment_reply WHERE comment_id=A.id) as num')->order($order)->limit($frist,$end)->select();		    	
       return $data;
    }	
	
	
	
}
?>
