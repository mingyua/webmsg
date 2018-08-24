<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Tlist extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	
    	
       return $this->fetch();
    }

}
