<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2018-2020 The MingYu                                   |
// +----------------------------------------------------------------------+
// | Authors: Original Author <285412937@qq.com>                          |
// |          MingYu <285412937@qq.com>                                   |
// +----------------------------------------------------------------------+
namespace app\manage\controller;
use think\Controller;
use think\Db;

class Auth extends Controller{
    protected function initialize()
    {
      $tags=db('tags')->order('sort ASC')->cache('tags',3600)->select(); 
       $this->tags=$tags;
       $this->assign('tags',$tags);
      $htusername=session('htusername');
      if(!$htusername){
      	$this->redirect('login/index');
      }
    }	
	
	
}
