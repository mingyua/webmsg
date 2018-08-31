<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Template extends Auth
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
    public function edit()
    {
    	$id=input('tempid');
    	$template=db('template')->where('id',$id)->find();
		$file_path = "./template/home/".$template['template'];
		if(file_exists($file_path)){
			$fp = fopen($file_path,"r");
			$str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
			$this->assign('content',$str);
		}else{
			$this->assign('content','文件不存在');
		}   
		$this->assign('template',$template);	
       return view();
    }


}
