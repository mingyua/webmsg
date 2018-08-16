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
use think\Model;
class Set extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	if($this->request->post()){
    		$post=$this->request->post();
    		$list=[];
    		$i=0;
    		foreach($post as $k=>$v){
    			$list[$i]['key']=$k;
    			$list[$i]['value']=$v;
    			$i++;
    		}
    		$res=model('Config')->isUpdate(true)->saveAll($list);
    		if(false===$res){
    			$back=['msg'=>'修改失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$back=['msg'=>'修改成功！','status'=>1,'icon'=>6,'url'=>''];
    		}
    		return $back;
    	}else{
	    	$list=model('Config')->where('id','gt',0)->select();
	    	$this->assign('list',$list);
	        return view();
	    		
    	}
        //
    }



}
