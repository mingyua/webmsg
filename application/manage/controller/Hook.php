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
    	if($this->request->post()){
    		$post=$this->request->post();
    		$atrid=isset($post['relationid'])?$post['relationid']:'';
    		if($atrid){
    		$post['relation']=$atrid.",".$post['relationname'];
    		}
    		if(isset($post['id'])){
    			$isupdate=true;
    		}else{
    			$isupdate=false;
    		}
    		$res=model('Hook')->isUpdate($isupdate)->allowField(true)->save($post);
    		if(false===$res){
    			$back=['msg'=>'操作失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
    		}

    		return $back;
    	}else{
    		$kinds=dyconfig('hookkinds',0);
			$this->assign('kinds',$kinds);
			$id=input('id');
			isset($id)?$info=db('hook')->where('id','eq',$id)->find():$info='';
			$this->assign('info',$info);
    		return view();
    	}
       
    }
    public function slidelist()
    {
    	$map[]=['kinds','eq',1];
    	$list=db('hook')->where($map)->select();
    	foreach($list as $k=>$v){
    		$relation=explode(',',$v['relation']);    		
    		$list[$k]['relationid']=isset($relation[0])?$relation[0]:'';
    		$list[$k]['relationname']=isset($relation[1])?$relation[1]:'';    		
    	}    	
		$data=['code'=>0,'msg'=>'','count'=>100,'data'=>$list];
        echo json_encode($data);
    }
    public function link()
    {
    	
       return view();
    }
    public function linklist()
    {
    	$map[]=['kinds','eq',2];
    	$list=db('hook')->where($map)->select();
		$data=['code'=>0,'msg'=>'','count'=>100,'data'=>$list];
        echo json_encode($data);
    }

	public function addlink(){
    		$kinds=dyconfig('hookkinds',1);
			$this->assign('kinds',$kinds);
			$id=input('id');
			isset($id)?$info=db('hook')->where('id','eq',$id)->find():$info='';
			$this->assign('info',$info);
		return view();		
	}   
    
    public function getlist($limit,$query)
    {
		$map[]=['title','like','%'.$query.'%'];
    	$article=db('article')->where($map)->field('id,title')->limit($limit)->select();

       echo  json_encode($article);
    }
    
 
 	public function status($id,$status){
		$table=input('table');
       if($status=='true'){
       	$st=1;
       }else{
       	$st=0;
       }
       
       db($table)->where('id',$id)->data(['status'=>$st])->update();
    }
 		
    public function delete($id)
    {
       $table=input('table');
   		$res=db($table)->delete($id);
   		if(false===$res){
   			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
   		}else{
   		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
   		}
       return $back;
    }
    public function alldel($data,$page)
    {
    	
    	$id=array_column($data,'id');
       	$res=db('hook')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('hook/'.$page)];
       	}
    	
       return $back;
    }
}
