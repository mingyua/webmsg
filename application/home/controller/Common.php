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
use think\facade\Config;
use think\Controller;
use think\Request;

class Common extends Controller
{
    protected function initialize()
    {
    	$input=input();
    	$this->catId=isset($input['catId'])?$input['catId']:'';
    	$this->id=isset($input['id'])?$input['id']:'';
    	$seocate=db('cate')->where('id',$this->catId)->find();
    	if($this->id){
    		$info=db('article')->where('id',$this->id)->find();
    		$seo=['title'=>$info['title']."-"];
    	}else{
    		    		
    		$this->childrenid=$seocate['childrenid'];    		
    		$info=db('article')->where('cateid',$seocate['id'])->find();
    		if($seocate['temp']==1){
    			$seo=['title'=>$info['title']."-"];
    		}else{
    			$seo=['title'=>$seocate['name']."-"];
    		}    		
    		
    	}
    	if($this->catId){
	    	$catelist=db('cate')->select();
	    	$fid=getprentsid($catelist,$this->catId);
	    	$mcate=db('cate')->where('id',$fid[0])->find();
	    	$allid=get_all_child($catelist,$fid[0]);    	  	
	    	$allid=array_merge($allid,$fid);
	    	$navbtn=db('cate')->where('id','in',$allid)->order('pid ASC')->select();
	    	$navinfo=db('cate')->where('id',$this->catId)->find();
	    	$this->assign('navinfo',$navinfo);
	    	$this->assign('mcate',$mcate);
	    	$this->assign('navbtn',$navbtn);
		}
    	$this->assign('seocate',$seocate);
       $this->assign('seo',$seo);
       $this->assign('catId',$this->catId);
       $this->assign('id',$this->id);
       $this->assign('info',$info);
    }
}