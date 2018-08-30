<?php

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
    	if($this->id){
    		$info=db('article')->where('id',$this->id)->find();
    		$seo=['title'=>$info['title']."-"];
    	}else{
    		$cate=db('cate')->where('id',$this->catId)->find();    		
    		$this->childrenid=$cate['childrenid'];    		
    		$info=db('article')->where('cateid',$cate['id'])->find();
    		if($cate['temp']==1){
    			$seo=['title'=>$info['title']."-"];
    		}else{
    			$seo=['title'=>$cate['name']."-"];
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
    	
       $this->assign('seo',$seo);
       $this->assign('catId',$this->catId);
       $this->assign('id',$this->id);
       $this->assign('info',$info);
    }
}
