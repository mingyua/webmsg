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
use think\facade\Env;
class Template extends Auth
{
	
	
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	$templist=db('template')->cache('template',2*60)->select();
    	$this->assign('templist',json_encode($templist));
       return view();
    }
	public function templist(){
    	$path=Env::get('TEMP_PATH');
		$filelist=glob($path.'*.html');
		$files=[];
		foreach($filelist as $k=>$v){
			$files[$k]['id']=basename($v);
			$files[$k]['filepath']=$v;
			$files[$k]['filename']=basename($v);
			$files[$k]['filesize']=unit(filesize($v));
			$files[$k]['tempname']=preg_replace('/\.\/template|\//', '', $path);
		}
		$data=['msg'=>0,'code'=>0,'count'=>count($files),'data'=>$files];
		echo json_encode($data);
				
	}

    public function set()
    {
    	$path='./template/';
		$filelist=glob($path.'*');
		$flood=[];
		foreach($filelist as $k=>$v){
			$json=json_decode(file_get_contents($v.'/config.json'),true);
			if(Env::get('TEMP_PATH')==$v."/"){$select='checked';}else{$select='';} 
			$flood[$k]=$json;
			$flood[$k]['id']=$k+1;			
			$flood[$k]['check']=$select;			
			$flood[$k]['template']=preg_replace('/\.\/template|\//', '', $v);			
		}
		$this->assign('template',$flood);
       return view();
    }
	public function tempcofig($id,$type){
		
		if($type=='temp'){
			$tempdir='./application/home/config/template.php';
			$envdir='./.env';
			$msgtemp=preg_replace('/\.\/template\/.*\//', './template/'.$id.'/', file_get_contents($tempdir));
			$msgenv=preg_replace('/\.\/template\/.*\//', './template/'.$id.'/', file_get_contents($envdir));
			file_put_contents($tempdir, $msgtemp);
			file_put_contents($envdir, $msgenv);
			$back=['msg'=>'模板启用成功','status'=>1];
		}else{
			$back=['msg'=>'出错了!','status'=>0];	
		}
		
		return $back;

	}
    public function edit()
    {
     	if($this->request->post()){
     		$post=$this->request->post();
     		if(isset($post['file'])){
				$myfile = fopen(Env::get('TEMP_PATH').$post['file'], "w") or die("Unable to open file!");
				$txt = $post['desc'];
				fwrite($myfile, $txt);
				fclose($myfile);     			
     			$back=['msg'=>'操作成功！','status'=>1,'icon'=>1,'url'=>''];	    	
     		}else{
     			$back=['msg'=>'操作1！','status'=>1,'icon'=>1,'url'=>''];	    	
     		}
     		return $back;die();
     	}else{
	    	$id=input('tempid');
			$file_path = Env::get('TEMP_PATH').$id;
			if(file_exists($file_path)){
				$fp = fopen($file_path,"r");
				$str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
				$this->assign('content',$str);
			}else{
				$this->assign('content','文件不存在');
			}   
			$this->assign('template',$id);

	       return view();
       }	
    }


}
