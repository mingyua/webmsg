<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Error extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
          return $this->fetch('error/index');
    }
	 public function _empty()
	    {
	        //把所有城市的操作解析到city方法
	       return $this->fetch('error/index');
	    }
  
}
