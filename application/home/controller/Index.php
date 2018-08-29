<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller
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
