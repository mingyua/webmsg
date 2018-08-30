<?php

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
    	$newslist=db('article')->where($map)->paginate(12);
    	$this->assign('newslist',$newslist);

        return $this->fetch();
    }
    public function show()
    {

        return $this->fetch();
    }

}
