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
class Set extends Auth
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
	    	$list=model('Config')->where('id','gt',0)->order('sort ASC')->select();
	    	$this->assign('list',$list);
	        return view();
	    		
    	}
        //
    }

	public function add(){
    	if($this->request->post()){
    		$post=$this->request->post();
    		$key=db('config')->where('key',$post['key'])->find();
    		if($key){
    			$back=['msg'=>'key已经存在!','status'=>2,'icon'=>2,'url'=>''];
    		}else{
	    		$res=db('config')->insert($post);
	    		if(false===$res){
	    			$back=['msg'=>'添加失败！','status'=>2,'icon'=>2,'url'=>''];
	    		}else{
	    			$back=['msg'=>'添加成功！','status'=>1,'icon'=>6,'url'=>''];
	    		}
    			
    		}
    		return $back;
    	}else{
    		return view();
    	}
		
		
	}
	public function edit(){
		$post=$this->request->post();
			$key=db('config')->where('key',$post['key'])->find();
			if($key && $post['field']=='key'){
				$back=['msg'=>'key已经存在!','status'=>2,'icon'=>2,'url'=>''];
			}else{
			
			$data[$post['field']]=$post['key'];
			$res=db('config')->where('id',$post['id'])->update($data);
			if(false===$res){
				$back=['msg'=>'添加失败！','status'=>2,'icon'=>2,'url'=>''];
			}else{
				$back=['msg'=>'添加成功！','status'=>1,'icon'=>6,'url'=>''];
			}
		}
		return $back;
		
	}
	
	public function setlist(){
    		$list=db('config')->order('sort asc')->select();
    		$menulist=['code'=>0,'msg'=>'','count'=>100,'data'=>$list];
    		echo json_encode($menulist);
		
	} 
    public function delete($id)
    {
   		$res=db('config')->delete($id);
   		if(false===$res){
   			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
   		}else{
   		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
   		}
       return $back;        
        
    }

}
