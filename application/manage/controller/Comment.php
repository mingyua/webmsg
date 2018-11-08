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
    public function reply()
    {
		$this->assign('cid',input('cid'));
    	
        return view();
        //
    }
    public function cate()
    {
    	

        return view();
        //
    }
    public function view($id,$page=1)
    {
    	$size=6;
    	$start=($page-1)*$size;

    	$map[]=['A.id','eq',$id];
		$info=model('Comment')->alias('A')->with('user')->join('comment_zan B',['B.touid=A.uid','B.tag=A.addtime'],'LEFT')->join('comment_zan C',['C.uid='.session('htuserid'),'C.tag=A.addtime'],'LEFT')->where($map)->field('A.*,A.addtime as time,COUNT(B.tag) as zan,C.uid as zanzt')->group('A.addtime')->find();
		$maps[]=['A.comment_id','eq',$id];
		$total=model('CommentReply')->alias('A')->where($maps)->count();
		
		$replay=model('CommentReply')->alias('A')->join('user U','A.uid=U.id')->join('comment_zan B',['B.touid=A.uid','B.tag=A.addtime'],'LEFT')->join('comment_zan C',['C.uid='.session('htuserid'),'C.tag=A.addtime'],'LEFT')->where($maps)->field('A.*,U.id,U.username,U.thumb as avatar,A.addtime as time,COUNT(B.tag) as zan,C.uid as zanzt')->group('A.addtime')->order('A.addtime desc')->limit($start,$size)->select();
		$this->assign('page',$page);
		$this->assign('size',$size);
		$this->assign('total',$total);
		//dump($info);die();
		if($this->request->post()){
			//sleep(3);
			return $replay;
		}		//dump($replay);die();
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
			$res=model('CommentReply')->allowField(true)->save($request);
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
	/*
	 *赞 
	 */
	public function zan(){
		if($this->request->post()){
			$post=$this->request->post();
			$post['uid']=session('htuserid');
			$post['addtime']=time();
			$map[]=['comment_id','eq',$post['comment_id']];
			$map[]=['uid','eq',session('htuserid')];
			$map[]=['touid','eq',$post['touid']];
			$map[]=['tag','eq',$post['tag']];
			$zan=db('comment_zan')->where($map)->find();
			//dump($zan);die();
			if(!empty($zan['tag'])){
				db('comment_zan')->where($map)->delete();
				return ['msg'=>'删除','status'=>2];
			}else{
				db('comment_zan')->insert($post);
				return ['msg'=>'添加','status'=>1];
			}
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
    	$where[]=['A.id','neq',0];
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
    public function replylist($key,$page,$limit)
    {
    	$fristlimit=($page-1)*$limit;
    	$where[]=['A.uid','neq',0];
    	$count=model('CommentReply')->alias('A')->where($where)->field('*')->count();
		$list=model('CommentReply')->pagelist($where,'addtime desc',$fristlimit,$limit);
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
    public function autolistuser()
    {
    	

        $menu=model('user')->select();
        $menulist=['code'=>0,'msg'=>'','count'=>count($menu),'data'=>$menu];
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
       	$res=db('comment')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('comment/index')];
       	}
    	
       return $back;
    }
    public function alldelcate($data)
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

       		$res=db('comment')->delete($id);
       		if(false===$res){
       			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       		}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
       		}
       
       
     return $back;   
    }
    public function delreply($id)
    {
			$input=explode('-',$id);
			$data[]=['comment_id','eq',$input[0]];
			$data[]=['addtime','eq',$input[2]];
			$data[]=['uid','eq',$input[1]];			
       		$res=db('comment_reply')->where($data)->limit(1)->delete();
       		if(false===$res){
       			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       		}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
       		}
       
       
     return $back;   
    }
    public function alldelreply($id)
    {
    	
		dump($id);die();
			$input=explode('-',$id);
			$data[]=['comment_id','eq',$input[0]];
			$data[]=['addtime','eq',$input[2]];
			$data[]=['uid','eq',$input[1]];			
       		$res=db('comment_reply')->where($data)->limit(1)->delete();
       		if(false===$res){
       			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       		}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
       		}
       
       
     return $back;   
    }
    
	
	
	
    public function deletecate($id)
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
