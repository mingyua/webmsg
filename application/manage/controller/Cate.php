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
use app\manage\model\Cate as Cates;
class Cate extends Auth
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view();
        //
    }

    /**
     * 添加修改资源
     *
     * 
     */
    public function add()
    {
    	if($this->request->post()){
    		
    		$post=$this->request->post();
    		if(isset($post['id'])){
    			$isupdate=true;
    		}else{
    			$isupdate=false;
    		}
    		$res=model('Cate')->isUpdate($isupdate)->allowField(true)->save($post);
    		if(false===$res){
    			$back=['msg'=>'操作失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$arr=db('cate')->field('id,pid')->select();  
    			model('Cate')->saveAll(allupdata($arr,'childrenid'));	
    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
    		}
    		return $back;
    	}else{
    		$id=input('id');
    		if(isset($id)){
    			$info=db('cate')->where('id',$id)->find();
    		}else{
    			$info='';
    		}
    		 
    		//模板列表
    		$templist=[['type'=>1,'name'=>'单页'],['type'=>2,'name'=>'列表']]; 
    		    		
    		
	        $menu=db('cate')->where('status',1)->select();
	        $list=menuTree($menu,'0','0');

	    	$this->assign('templist',$templist);
	    	$this->assign('pid',$list);
	    	$this->assign('info',$info);
    		
	        return view();
	    		
    	}

    }
    /**
     * 加载指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function catelist()
    {
    	

        $menu=db('cate')->select();
        $list=menuTree($menu,'0');
        foreach($list as $k=>$v){
        	$list[$k]['tempname']=$v['temp']>1 ? '列表':'单页';
        }
        $menulist=['code'=>0,'msg'=>'','count'=>count($list),'data'=>$list];
        echo json_encode($menulist);
        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function status($id,$status)
    {
       if($status=='true'){
       	$st=1;
       }else{
       	$st=0;
       }
       
       db('cate')->where('id',$id)->data(['status'=>$st])->update();
    }

    /**
     * 批量删除.
     *
     * @return $data
     */
    public function alldel($data)
    {
    	$id=array_column($data,'id');
       	$res=db('cate')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('cate/index')];
       	}
    	
       return $back;
    }
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
       $pid=db('cate')->where('pid',$id)->find();
       if($pid){
       		$back=['msg'=>'请先删除子栏目！','status'=>2,'icon'=>5,'url'=>''];
       }else{
       		$res=db('cate')->delete($id);
       		if(false===$res){
       			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       		}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
       		}
       }
       
     return $back;   
    }
}
