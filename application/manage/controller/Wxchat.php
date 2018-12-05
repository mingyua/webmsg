<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;
use wxpay\Wechat; 
class Wxchat extends Controller
{
	public function initialize(){
		
		$this->weixin = new Wechat("wxe3fec0b1bc8130e3", "f9fadff1fad55f570686bf2d66c86e51");
		
	
	}
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	

		$wxmenu=db('wxmenu')->select();
			$arr=catechannel($wxmenu,0,1);
			$Tree=[];
			foreach($arr as $k=>$v){
				
				$Tree[$k]=array_filter($v);
				if($v['children']){
					foreach($v['children'] as $kk=>$vv){
						$Tree[$k]['sub_button'][$kk]=array_filter($vv);
						unset($Tree[$k]['children']);
					}
					
				}else{
					$Tree[$k]['sub_button']=[];
				}
				
			}
			//dump(array_sort($Tree, 'sort'));
			$data=['menu'=>array('button'=>array_sort($Tree, 'sort'))]; 
			//file_put_contents('./sort.json', json_encode($data));
		$this->assign('wxmenudata',json_encode($data));
       return view();
    }

    /**
     * 添加菜单
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function addMenu()
    {
    	if($this->request->post()){
    		$post=$this->request->post();
			$wxmenu=db('wxmenu')->where('pid',$post['pid'])->count('id');
									
			if($wxmenu>=0){				
				$res=db('wxmenu')->where('id',$post['pid'])->update(['type'=>null,'url'=>null,'key'=>null,'addtime'=>time()]);					
			}
			$data = ['pid' => $post['pid'],'name'=>'子菜单', 'type' => 'view','url'=>'http://www.xxx.com','sort'=>1,'addtime'=>time()];
			$inset=db('wxmenu')->insertGetId($data);
			if($inset>1){
				$back=['id'=>$inset,'status'=>1,'act'=>'add'];
			}else{
				$back=['id'=>'im e ','status'=>0,'act'=>'add'];
			}
			
			return $back;
    	}
        
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delMenu($pid)
    {
    	
		$wxmenu=db('wxmenu')->where('id',$pid)->find();	
		if($wxmenu['pid']==0){
			db('wxmenu')->where('pid',$pid)->delete();	
		}else{
			$count=db('wxmenu')->where('pid',$wxmenu['pid'])->count('id');
			if($count==1){
				$data = ['type' => 'view','key'=>'col_','url'=>'http://www.xxx.com'];
				$update=db('wxmenu')->where('id',$wxmenu['pid'])->update($data);					
			}
		}
		$res=db('wxmenu')->where('id',$pid)->delete();		
		if(false===$res){
			$back=['msg'=>'删除失败!','status'=>0,'act'=>'delMenu'];
		}else{
			$back=['msg'=>'删除成功!','status'=>1,'act'=>'delMenu'];
			
		}
        return $back;
		
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
    	$post=$this->request->post();
			$data['pid']=$post['itemid'];
			$data['name']=$post['name'];
			$data['type']=$post['type'];
			$data['sort']=$post['sort'];
			
			if($post['type']=='view'){				
				$data['url']=$post['url'];
				$data['key']=null;
				$data['unid']=null;
			}else{
				$data['url']=null;
				$data['key']='col_'.$post['menuid'];
				$data['unid']=$post['unid'];
			}
		$res=db('wxmenu')->where('id',$post['menuid'])->update($data);
		
		if(false===$res){
			$back=['msg'=>'操作失败!','status'=>0,'icon'=>0,'url'=>''];
		}else{
			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
			
		}
        return $back;
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function lists($page,$limit,$title='')
    {
    	$fristlimit=($page-1)*$limit;
		$where[]=['id','neq',0];
		$where[]=['title','like','%'.$title.'%'];
		$count=db('wxarticle')->where($where)->count('id');
       $list=db('wxarticle')->where($where)->field('id,title,desc,thumb')->order('id DESC')->limit($fristlimit,$limit)->select();
	   $data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
	   return $data;
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function rightlist($pid)
    {
     $res=db('wxmenu')->where('id',$pid)->find();
	 if(isset($res['unid'])){
	 	$data=db('wxarticle')->whereIn('id',$res['unid'])->select();
		 
	 } else{
	 	$data=[];
	 }		
	return ['msg'=>'ok','status'=>1,'act'=>'rightlist','data'=>$data];
    }
	
	//微信文章管理
	public function wxarticle(){
		
		return view();
	}
	
	//微信文章列表
	public function wxalist($key='',$page,$limit)
    {
    	
		if(isset($key['title'])){
			$title=$key['title'];
		}else{
			$title='';
		}
    	$fristlimit=($page-1)*$limit;
		$where[]=['title','like','%'.$title.'%'];
		$count=model('Wxart')->where($where)->count('id');
       	$list=model('Wxart')->where($where)->order('id DESC')->field('id,title,thumb,addtime')->limit($fristlimit,$limit)->select();
        $wxalist=['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
        echo json_encode($wxalist);        
    }
	
	//添加微信文章
	public function wxadd(){
		if($this->request->post()){
			$post=$this->request->post();
			$post['addtime']=toDate(2,$post['addtime']);
			if(isset($post['id'])){
				$result=model('Wxart')->allowField(true)->save($post,['id'=>$post['id']]);	    		
	    		if(false===$result){
	    			$back=['msg'=>'操作失败，请重试！','status'=>2,'icon'=>0,'url'=>''];
	    		}else{
	    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>1,'url'=>url('wxchat/wxarticle')];	    			
	    		}
			}else{
				$result=model('Wxart')->allowField(true)->save($post);
	    		if(false===$result){
	    			$back=['msg'=>'操作失败，请重试！','status'=>2,'icon'=>0,'url'=>''];
	    		}else{
	    			$back=['msg'=>'操作成功！','status'=>1,'icon'=>1,'url'=>url('wxchat/wxarticle')];	    			
	    		}
			}
			return $back;			
		}else{
	    	$input=input();
	    	if(isset($input['id'])){    		
	    		$map[]=['id','eq',$input['id']];
				$info=model('Wxart')->where($map)->find();
			}else{
				$info='';
			}
			
			$this->assign('info',$info);
			return view();
		}
		
	}
    public function alldel($data)
    {
    	$id=array_column($data,'id');
       	$res=db('wxarticle')->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('wxchat/wxarticle')];
       	}
    	
       return $back;
    }
	
	//微信菜单生成
	public function createMenu(){
		$newlist=db('wxmenu')->order('sort asc')->select();
		$arr=catechannel($newlist,0,1);
		$newlist=[];
		foreach($arr as $k=>$v){
			$newlist[$k]['name']=$v['name'];			
			if(isset($v['type'])){
				$newlist[$k]['type']=$v['type'];
				if($v['type']=='click'){					
					$newlist[$k]['key']=$v['key'];
				}else if($v['type']=='view'){
					$newlist[$k]['url']=$v['url'];
				}
			}else{
				$i=0;
				$arrsort=array_sort($v['children'], 'sort');
				foreach($arrsort as $kk=>$vv){
					$newlist[$k]['sub_button'][$i]['name']=$vv['name'];
					$newlist[$k]['sub_button'][$i]['type']=$vv['type'];
				if($vv['type']=='click'){
					
					$newlist[$k]['sub_button'][$i]['key']=$vv['key'];
				}else if($vv['type']=='view'){

					$newlist[$k]['sub_button'][$i]['url']=$vv['url'];
				}
					$i++;
				}
				
			}
		}			
		$data=array('button'=>$newlist); 			
		$menu=$this->weixin->menu_create(json_encode($data,JSON_UNESCAPED_UNICODE));
		if($menu['errmsg']=='ok'){
			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6];
		}else{
			$back=['msg'=>$menu['errmsg'],'status'=>0,'icon'=>5];
		}
		return $back;
	}
	
	//
	public function menu_delete()
	{
		$menus=$this->weixin->menu_delete();
		if($menus['errmsg']=='ok'){
			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6];
		}else{
			$back=['msg'=>$menus['errmsg'],'status'=>0,'icon'=>5];
		}
		
		return $back;

	}
	/*发送客服消息 必须最近有消息来往否则不成功
	 * $openid 不能为空
	 * $msg 不能为空 
	 */	
	public function wxsendmsg($openid,$msg)
	{
		$sendmsg=$this->weixin->send_custom_message($openid, "text", $msg);		
		$info=$this->weixin->get_user_info($openid);
		if($sendmsg['errmsg']=='ok'){
			$back=['msg'=>'操作成功！','status'=>1,'icon'=>6];
		}else{
			$back=['msg'=>$sendmsg['errmsg'],'status'=>0,'icon'=>5];
		}
		return $back;
		//dump($sendmsg);

	}
	/* 获取关注用户列表
	 * 
	 */
	public function wxgetlist(){
		$cc=$this->weixin->get_user_list();
		dump($cc);
	}
	/* 获取用户信息
	 * 
	 */
	public function wxgetinfo($openid){
		$info=$this->weixin->get_user_info($openid);
		
		return $info;
	}
	
	
	//微信接口
	public function wxset()
	{
		
		return view();
	}
		
	
}
