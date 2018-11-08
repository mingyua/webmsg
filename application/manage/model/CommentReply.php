<?php

namespace app\manage\model;

use think\Model;

class CommentReply extends Model
{
    protected $name = 'comment_reply';// 设置当前模型对应的数据表名称
    protected $pk = 'addtime';// 设置主键
    protected $createTime = 'addtime';
	protected $updateTime = 'uptime';

    public function pagelist($where,$order,$frist,$end)
    {
    	$data=db('comment_reply')->alias('A')->join('user D','A.uid=D.id')->join('comment C','A.comment_id=C.id')->field('A.*,C.id,C.title,D.username,D.thumb,FROM_UNIXTIME(A.addtime,"%Y/%d/%m %H:%i:%s") as time')->order($order)->limit($frist,$end)->select();		    	
       return $data;
    }	

    //
}
