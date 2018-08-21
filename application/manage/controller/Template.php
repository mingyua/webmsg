<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Template extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	$templist=db('template')->cache('template',2*60)->select();
    	$this->assign('templist',json_encode($templist));
       return view();
    }


}
