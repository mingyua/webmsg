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

class Comment extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
 
 
    	$map[]=['A.pid','eq',0];
    	$cc= model('Comment')->pagelist($map,'addtime desc',0,10);
    	//dump($cc);
		$this->assign('cid',input('cid'));
        return view();
        //
    }
    public function cate()
    {
        return view();
        //
    }
    public function view($id)
    {
    	$map[]=['id','eq',$id];
		$info=model('Comment')->with('user')->where($map)->find();
		$maps[]=['pid','eq',$id];
		$replay=model('Comment')->with('user')->where($maps)->order('addtime desc')->select();
		//dump($replay);
		$this->assign('replay',$replay);
		$this->assign('info',$info);
        return view();
        //
    }

    /**
     * 添加修改资源
     *
     * 
     */
     
     
    public function addcomment()
    {
    	if($this->request->post()){
    		
    		$post=$this->request->post();
    		if(isset($post['id'])){
    			$isupdate=true;
    		}else{
    			$isupdate=false;
    		}
    		$res=model('Comment')->isUpdate($isupdate)->allowField(true)->save($post);
    		if(false===$res){
    			$back=['msg'=>'操作失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
    		}
    		return $back;
    	}else{
    		$id=input('id');
    		if(isset($id)){
    			$info=db('comment')->where('id',$id)->find();
    		}else{
    			$info='';
    		}
    		 
    		//模板列表
	        $menu=db('comment_cate')->where('status',1)->select();
	        $list=menuTree($menu,'0','0');	
			
	    	$this->assign('pid',$list);
	    	$this->assign('info',$info);
    		
	        return view();
	    		
    	}

    }
	/*
	 * 添加回复
	*/
	public function addreplay(){
		if($this->request->post()){
			$request=$this->request->post();
			$request['status']=1;
			$res=model('Comment')->allowField(true)->save($request);
    		if(false===$res){
    			$back=['msg'=>'操作失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
    		}
			
			return $back;
		}
	}
    public function addcommentcate()
    {
    	if($this->request->post()){
    		
    		$post=$this->request->post();
    		if(isset($post['id'])){
    			$isupdate=true;
    		}else{
    			$isupdate=false;
    		}
    		$res=model('Commentcate')->isUpdate($isupdate)->allowField(true)->save($post);
    		if(false===$res){
    			$back=['msg'=>'操作失败！','status'=>2,'icon'=>2,'url'=>''];
    		}else{
    			$arr=db('comment_cate')->field('id,pid')->select();  
    			model('Commentcate')->saveAll(allupdata($arr,'childrenid'));	
    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
    		}
    		return $back;
    	}else{
    		$id=input('id');
    		if(isset($id)){
    			$info=db('comment_cate')->where('id',$id)->find();
    		}else{
    			$info='';
    		}
    		 
    		//模板列表
	        $menu=db('comment_cate')->where('status',1)->select();
	        $list=menuTree($menu,'0','0');	
			
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

    public function commentlist($key,$page,$limit)
    {
    	
    	$fristlimit=($page-1)*$limit;
    	$map[]=['pid','eq',0];
    	$arr=db('comment_cate')->where($map)->select();
    	
    	
    	$input=array_filter($key,function($item){
    		 return $item !== '';
    	});
    	$where[]=['A.pid','eq',0];
    	foreach($input as $k=>$v){
    		
    		if($k=='addtime'){
    			$time=toArr($v,' - ');
    			$where[]=[$k,'between',[$time[0],$time[1]]];
    		}else if($k=='title'){
    			$where[]=[$k,'like','%'.$v.'%'];
    		}else if($k=='cid'){
    			$id=get_all_child($arr,$v);
    			$id=array_merge($id,array($v));
    			$where[]=['cateid','IN',$id];
    		}else{
    			$where[]=[$k,'eq',$v];
    		}
    	}    	
    	$count=model('Comment')->alias('A')->where($where)->field('*')->count();
		$list=model('Comment')->pagelist($where,'addtime desc',$fristlimit,$limit);
        $articlelist=['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
        echo json_encode($articlelist);        
    }
    public function commentcatelist()
    {
    	

        $menu=model('Commentcate')->select();
		$list=menuTree($menu,'0','0');	
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
       
       db('comment_cate')->where('id',$id)->data(['status'=>$st])->update();
    }

    /**
     * 批量删除.
     *
     * @return $data
     */
    public function alldel($data)
    {
    	$id=array_column($data,'id');
       	$res=db('comment_cate')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('comment/cate')];
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
       $pid=db('comment_cate')->where('pid',$id)->find();
       if($pid){
       		$back=['msg'=>'请先删除子栏目！','status'=>2,'icon'=>5,'url'=>''];
       }else{
       		$res=db('comment_cate')->delete($id);
       		if(false===$res){
       			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       		}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
       		}
       }
       
     return $back;   
    }

}
