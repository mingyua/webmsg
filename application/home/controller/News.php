<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2018-2020 The MingYu                                   |
// +----------------------------------------------------------------------+
// | Authors: Original Author <285412937@qq.com>                          |
// |          MingYu <285412937@qq.com>                                   |
// +----------------------------------------------------------------------+

namespace app\home\controller;

use think\Controller;
use think\Request;

class News extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	$map[]=['cateid','in',$this->childrenid];
    	$map[]=['status','eq',1];
    	$newslist=db('article')->where($map)->paginate(12);
    	$this->assign('newslist',$newslist);

        return $this->fetch();
    }
    public function show()
    {

        return $this->fetch();
    }

}