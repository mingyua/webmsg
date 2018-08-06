<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

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
        $menu=db('menu')->where($map)->order('sort ASC')->select();
        $list=getchildren($menu,'0');
        $this->assign('menulist',$list);  
        return $this->fetch();
    }
    public function center()
    {      
    	

    	
    	$quick=db('shortcut')->where('status',1)->order('sort ASC')->select();
    	$qlist=[];$i=1;
    	foreach($quick as $k=>$v){
    		if ($i%8==0){
    			$qlist[0][]=$v;
    		}else{
    			$qlist[1][]=$v;
    		} 
    		$i++;
    	}
    	
    	
    	//dump($qlist);
    	$this->assign('qlist',$qlist);  
    	$this->assign('title','我是测试');  
        return view();
    }
    public function a()
    {      
    	$this->assign('title','我是测试');  
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
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
