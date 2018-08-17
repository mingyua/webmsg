<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Hook extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
       return view();
    }
    public function slide()
    {
       return view();
    }
    public function addslide()
    {
       return view();
    }
    public function slidelist()
    {
		$data=['code'=>0,'msg'=>'','count'=>0,'data'=>[]];
        echo json_encode($data);
    }
    public function link()
    {
       return view();
    }
    public function getlist()
    {

    	$article=db('article')->limit(5)->select();
    	$data=[];
    	foreach($article as $k=>$v){
    		$data[$k]['value']=$v['title'];
    		$data[$k]['id']=$v['id'];
    	}
       echo  json_encode($data);
    }
    
    
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
