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
use app\manage\model\Article as Art;
use app\manage\model\Cate;

class Article extends Auth
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
    	$cate=menuTree($arr,'0');
    	$this->assign('cate',$cate);
    	$this->assign('cid',input('cid'));
    	$this->assign('pid',input('pid'));
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function articlelist($key,$page,$limit)
    {
    	
    	$fristlimit=($page-1)*$limit;
    	$map[]=['temp','neq',1];
    	$arr=db('cate')->where($map)->select();
    	
    	
    	$input=array_filter($key,function($item){
    		 return $item !== '';
    	});
    	$where[]=['id','neq',0];
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
    	
    	//dump($where);
    	//$where[]=[''];
    	$count=Art::field('*')->count();
        $list=Art::with(['cate'=>function($query){ $query->field('id,pid,name'); }])->where($where)->order('addtime desc')->limit($fristlimit,$limit)->select();
        foreach($list as $k=>$v){
        	$list[$k]['catename']=$v['cate']['name'];
        }        
        $articlelist=['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
        echo json_encode($articlelist);        
    }
    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function single()
    {
       $singlelist=Cate::with(['cateart'=>function($query){$query->field('id,cateid,title,thumb,desc');}])->where('temp',1)->field('id,name,temp')->select();
       //dump($singlelist);
       $this->assign('singlelist',$singlelist);
       return view();
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function add()
    {
    	
	    if($this->request->post()){
	    	$post=array_filter($this->request->post());
	    	$post['addtime']=toDate(2,$post['addtime']);
	    	if($post['temp']==1){
	    		$name="单页管理";
	    		$jumpurl=URL('article/single');
	    	}else{
	    		$name="文章列表";
	    		$jumpurl=URL('article/index');
	    	}
	    	
	    	if(isset($post['imglist'])){
	    		$imglist=toArr($post['imglist'],',');
	    		$dataimg=[];
	    		foreach($imglist as $k=>$v){
	    			$img=toArr($v,"':'");
	    			$dataimg[$img[0]]['sort']=trim($img[0]);
	    			$dataimg[$img[0]]['thumb']=trim($img[1]);
	    			
	    		}
				
	    		$post['thumb']=$dataimg[0]['thumb'];
	    	}
	    	
	    	$art = new Art;
	    	if(isset($post['id'])){				
				$result=$art->allowField(true)->save($post,['id'=>$post['id']]);	    		
	    		if(false===$result){
	    			$back=['msg'=>'操作失败，请重试！','status'=>2,'icon'=>0,'url'=>''];
	    		}else{
	    			if(isset($dataimg)){
		    			$data=addarr($dataimg,'artid',$post['id']);						
		    			db('thumb')->where('artid',$post['id'])->delete();
		    			db('thumb')->insertAll($data);	 
	    			}   			
	    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>1,'url'=>$jumpurl,'name'=>$name];	    			
	    		}
	    		
	    	}else{
	    		
				$result=$art->allowField(true)->save($post);
	    		if(false===$result){
	    			$back=['msg'=>'操作失败，请重试！','status'=>2,'icon'=>0,'url'=>''];
	    		}else{
	    			if(isset($dataimg)){
	    				
		    			$data=addarr($dataimg,'artid',$art->max('id'));						
		    			db('thumb')->insertAll($data);	
	    			}    				    			
	    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>1,'url'=>$jumpurl,'name'=>$name];	    			
	    		}
	    		
	    		
	    	}
	    	return $back;	    	
	    }else{
	    	$input=input();
	    	if(isset($input['id'])){    		
	    		$map[]=['id','eq',$input['id']];
	    	}else if(isset($input['cid'])){
	    		
	    		$map[]=['cateid','eq',$input['cid']];
	    	}else{
	    		$map=false;
	    	}
	    	
	    	if($map){
		        	$info=Art::with(['cate'=>function($query){ $query->field('id,pid,name,temp'); }])->where($map)->find();
	        	if(!$info){
	        		$catename=db('cate')->where('id',$input['cid'])->value('name');
	        		$data = ['cateid' => $input['cid'],'title'=>$catename,'addtime' => time()];
	        		$res=db('article')->data($data)->insert();
	        		if($res){
		        	$info=Art::with(['cate'=>function($query){ $query->field('id,pid,name,temp'); }])->where($map)->find();
		        	}
	        	}
	        	$thumb=db('thumb')->where('artid',$info['id'])->order('sort ASC')->select();
	        	$this->assign('thumblist',$thumb);
	    	}else{
	    		$info='';
	    	}
	    	$where[]=['status','eq','1'];
	    	$where[]=['temp','neq',1];
	    	$arr=db('cate')->where($where)->select();   	
	    	$cate=menuTree($arr,'0');
	    	
	    	
	    	
	    	
	    	$this->assign('cate',$cate);
	       $this->assign('info',$info);
	       return view();	    	
	    }	
    	
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function alldel($data)
    {
    	$id=array_column($data,'id');
       	$res=db('article')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('article/index')];
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
   		$res=db('article')->delete($id);
   		if(false===$res){
   			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
   		}else{
   		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('article/index')];
   		}
       return $back;        
        
    }
 	public function status($id,$status){

       if($status=='true'){
       	$st=1;
       }else{
       	$st=0;
       }
       
       db('article')->where('id',$id)->data(['status'=>$st])->update();
    }
    
    
}
