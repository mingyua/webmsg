<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;
use app\manage\model\Article as Art;
use app\manage\model\Cate;
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
    public function articlelist($cid)
    {
    	
    	$map[]=['temp','neq',1];
    	$arr=db('cate')->where($map)->select();
    	$id=getchildrenId($arr,$cid);
        $list=Art::with(['cate'=>function($query){ $query->field('id,pid,name'); }])->whereIn('cateid',$id)->select();
        foreach($list as $k=>$v){
        	$list[$k]['catename']=$v['cate']['name'];
        }        
        $articlelist=['code'=>0,'msg'=>'','count'=>count($list),'data'=>$list];
        echo json_encode($articlelist);        
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function edit()
    {
        return $this->fetch();//
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
		    			$data=addarr($dataimg,'artid',$result->id);
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
