<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Menu extends Controller
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
     * 显示创建资源表单页.
     *
     * @return \think\Response
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
    		$res=model('Menu')->isUpdate($isupdate)->allowField(true)->save($post);
    		if(false===$res){
    			$back=['msg'=>'操作失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
    		}
    		return $back;
    	}else{
    		$id=input('id');
    		if(isset($id)){
    			$info=db('menu')->where('id',$id)->find();
    		}else{
    			$info='';
    		}
    		    		
	        $menu=db('menu')->where('status',1)->select();
	        $list=menuTree($menu,'0','0','└');
	    	 	
	    	$this->assign('pid',$list);
	    	$this->assign('info',$info);
    		
	        return view();
	    		
    	}

    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function alldel($data)
    {
    	$id=array_column($data,'id');
       	$res=db('menu')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('menu/index')];
       	}
    	
       return $back;
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
    public function menulist()
    {
        $menu=db('menu')->select();
        $list=menuTree($menu,'0');
        $menulist=['code'=>0,'msg'=>'','count'=>100,'data'=>$list];
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
       
       db('menu')->where('id',$id)->data(['status'=>$st])->update();
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
       $pid=db('menu')->where('pid',$id)->find();
       if($pid){
       		$back=['msg'=>'请先删除子栏目！','status'=>2,'icon'=>5,'url'=>''];
       }else{
       		$res=db('menu')->delete($id);
       		if(false===$res){
       			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       		}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
       		}
       }
       
     return $back;   
    }
}
