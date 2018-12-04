<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Wxchat extends Controller
{
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
		$wxlist=array_sort($Tree, 'sort');
		foreach($wxlist as $k=>$v){
			unset($wxlist[$k]['id']);
			unset($wxlist[$k]['pid']);
			unset($wxlist[$k]['sort']);
			unset($wxlist[$k]['addtime']);
			unset($wxlist[$k]['level']);
			unset($wxlist[$k]['unid']);
			if($v['sub_button']){
				foreach($v['sub_button'] as $kk=>$vv){
					unset($wxlist[$k]['sub_button'][$kk]['id']);
					unset($wxlist[$k]['sub_button'][$kk]['pid']);
					unset($wxlist[$k]['sub_button'][$kk]['sort']);
					unset($wxlist[$k]['sub_button'][$kk]['addtime']);
					unset($wxlist[$k]['sub_button'][$kk]['level']);
					unset($wxlist[$k]['sub_button'][$kk]['unid']);

				}
				
			}			
		}	
				
		$data=['menu'=>array('button'=>$wxlist)]; 
		
		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'data'=>json_encode($data)];
		return $back;
	}
	
	//微信接口
	public function wxset()
	{
		
		return view();
	}
		
	
}
