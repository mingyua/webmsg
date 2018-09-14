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
use think\Db;

class Index extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	
    	$this->assign('id',input('id'));
       return $this->fetch();
    }
    public function angulerjs()
    {
    	$nav=db('cate')->select();
    	$navs=catechannel($nav);
    	//dump($navs);
       return $this->fetch();
    }
}