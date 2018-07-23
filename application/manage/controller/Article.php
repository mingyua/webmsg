<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Article extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	$map[]=['temp','neq',1];
    	$arr=db('cate')->where($map)->select();
    	$id=getchildrenId($arr,input('cid'));
    	///dump($id);
    	$this->assign('cid',input('cid'));
    	$this->assign('pid',input('pid'));
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function articlelist($cid)
    {
    	
    	$map[]=['temp','neq',1];
    	$arr=db('cate')->where($map)->select();
    	$id=getchildrenId($arr,$cid);
        $list=db('article')->whereIn('cateid',$id)->select();        
        $articlelist=['code'=>0,'msg'=>'','count'=>count($list),'data'=>$list];
        echo json_encode($articlelist);        
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
    public function add($cid)
    {
       return view();
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
