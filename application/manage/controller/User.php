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
use think\Db;
use app\manage\model\User as Users;
class User extends Controller
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
    public function userlist($page,$limit)
    {
		$fristlimit=($page-1)*$limit;
    	$count=Users::field('*')->count();
    	$where[]=['id','neq',0];
        $user=Users::with(['group'=>function($query){ $query->field('id,name,desc'); }])->where($where)->order('addtime desc')->limit($fristlimit,$limit)->select();
		foreach($user as $k=>$v){
			$user[$k]['groupname']=$v['group']['name'];			
		}
		$userlist=['code'=>0,'msg'=>'','count'=>$count,'data'=>$user];
        echo json_encode($userlist);

    }
    public function adduser()
    {
    	if($this->request->post()){
    		$post=$this->request->post();
    		
			 $validate = new \app\manage\validate\User;

	        if (!$validate->check($post)) {
	        	return $back=['msg'=>$validate->getError(),'status'=>0,'icon'=>0,'url'=>''];die();	            
	        }
	        if($post['userpwd']==''){
				unset($post['userpwd']);
    		}else{
	    		$post['userpwd']=md5($post['userpwd']);     			
    		}	
    		if(isset($post['id'])){
    			$user=model('User')->allowField(true)->save($post,['id'=>$post['id']]);
    		} else{
    			$user=model('User')->allowField(true)->save($post);
    		}  		
    		
    		if(false===$user){
    			$back=['msg'=>'操作失败','status'=>0,'icon'=>0,'url'=>''];
    		}else{
	    		$back=['msg'=>'操作成功','status'=>1,'icon'=>1,'url'=>url('user/index')];    			
    		}
    		return $back;
    	}else{ 
    		$input=input();
    		if(isset($input['id'])){
    			$map[]=['id','eq',$input['id']];
    			$info=model('User')->where($map)->with('group')->find();
    		}else{
    			$info='';
    		}
    		//dump($info);
    		$glist=db('group')->select();
    		$this->assign('glist',$glist);
    		$this->assign('info',$info);
    		return view();
    	}
        
    }
    public function group()
    {
        return view();
    }
    public function usergroup(){
    	$gro=model('Group')->where('id','gt',0)->select();
    	$grolist=['code'=>0,'msg'=>'','count'=>'','data'=>$gro];
        echo json_encode($grolist);

    }
    public function addgroup(){
    	$post=$this->request->post();
    	if(isset($post['id'])){
    		$data[$post['name']]=$post['val'];
    		$gro=model('Group')->allowField(true)->save($data,['id'=>$post['id']]);
    	}else{
    		$gro=model('Group')->save($post);
    	}
    	
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
   		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('user/index')];
   		}
       return $back;
    }
    public function alldel($data)
    {
    	$id=array_column($data,'id');
       	$res=db('user')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('user/index')];
       	}
    	
       return $back;
    }
    public function auth($id){
    	//菜单
    	$menu=model('Menu')->with('auth')->field('id,pid,name,url')->select();
    	foreach($menu as $k=>$v){
    		if(isset($v['auth']) && $v['auth']['groupid']==$id){
				$menu[$k]['checked']='ture';   			
    		} 
    		unset($menu[$k]['auth']); 		
    	}
    	$this->assign('menulist',json_encode(catechannel($menu)));
    	$map[]=['id','eq',input('id')];
    	$info=db('group')->where($map)->find();
    	$group=db('group')->select();
    	$this->assign('json',json_encode($group));
    	$this->assign('info',$info);
    	return view();
    }
    public function authedit($id){
    	db('auth')->where('groupid','eq',$id)->delete();
    	$post=$this->request->post('data');
    	
    	$data=[];
    	foreach($post as $k=>$v){
    		$data[$k]['groupid']=$id;
    		$data[$k]['menuid']=$v['id'];
    		$data[$k]['menuurl']=$v['url'];    		
    	};
    	
    	$result=Db::name('auth')->insertAll($data);
    	if(false===$result){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];    		
    	}else{
			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('user/group')];    		
    	}
		return $back;
    }
 
}
