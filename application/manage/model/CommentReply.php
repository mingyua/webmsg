<?php

namespace app\manage\model;

use think\Model;

class CommentReply extends Model
{
    protected $name = 'comment_reply';// 设置当前模型对应的数据表名称
    protected $pk = '';// 设置主键
    protected $createTime = 'addtime';
	protected $updateTime = 'uptime';
    //
}
