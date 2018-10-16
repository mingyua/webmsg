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
use think\Request;
use think\facade\Cache;
class index extends Auth
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	$map[] = ['status','=',1];
        $menu=db('menu')->where($map)->cache('menu',1000)->order('sort ASC')->select();
        $list=getchildren($menu,'0');
        $this->assign('menulist',$list);  
        return $this->fetch();
    }
    public function center()
    {
    	$map[]=['id','eq',session('htuserid')];
    	$uinfo=db('user')->where($map)->find();      
    	$quick=db('shortcut')->where('status',1)->order('sort ASC')->select();
    	$qlist=[];$i=1;
    	foreach($quick as $k=>$v){
    		if ($i%9==0){
    			$qlist[0][]=$v;
    		}else{
    			$qlist[1][]=$v;
    		} 
    		$i++;
    	}
    	$this->assign('uinfo',$uinfo);  
    	$this->assign('qlist',$qlist);  
        return view();
    }
    public function clearCache()
    {      
	    header("Content-type: text/html; charset=utf-8");
		clearCache('./runtime/');
		Cache::clear(); 
		return ['msg'=>'清除缓存成功!','status'=>1,'icon'=>1,'url'=>''];
	}

	public function geturl(){
		if(session('htuserid')==1){
		 return	['msg'=>'有权访问','status'=>1,'icon'=>1];	
		}
		$gid=session('htgid');
		$url=preg_replace('/(\?.*|.html|\/manage\/)/i','',input('data'));
		$url=explode('/', $url);
		$url=$url[0]."/".$url[1];		
		$map[]=['groupid','eq',$gid];
		$menu=db('auth')->where($map)->cache('auth',0)->select();
		$urllist=array_filter(array_column($menu,'menuurl'));		
		if(in_array($url,$urllist)){
			$back= ['msg'=>'有权访问','status'=>1,'icon'=>1];	
		}else{
			$back= ['msg'=>'您无权访问此页面!','status'=>0,'icon'=>5];	
		}
		return $back;
	}
}
