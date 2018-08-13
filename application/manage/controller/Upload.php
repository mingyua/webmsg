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
use think\Db;
use think\facade\Session;
class Upload extends Controller
{
	//单个文件上传
    public function index()
    {
		$file = request()->file('file');
	    // return ['msg'=>json_encode($file),'status'=>2];
	       $path='./public/uploads';   
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    if($file){
	        $info = $file->move($path);
	        if($info){
	        	Session::set('files',$path."/".$info->getSaveName());
	        	return ['msg'=>'上传成功！','status'=>1,'data'=>$path."/".$info->getSaveName()];
	        }else{
	            // 上传失败获取错误信息
	            return ['msg'=>$file->getError(),'status'=>2];
	          
	        }
	    }    	
    }
    
    public function uploads()
    {
		$file = request()->file('file');
	    // return ['msg'=>json_encode($file),'status'=>2];
	       $path='./public/uploads';   
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    if($file){
	        $info = $file->move($path);
	        if($info){
	        	return ['msg'=>'上传成功！','status'=>1,'data'=>$path."/".$info->getSaveName()];
	        }else{
	            // 上传失败获取错误信息
	            return ['msg'=>$file->getError(),'status'=>2];
	          
	        }
	    }    	
   	
    }
    public function avatar()
    {
    	$post=$this->request->post('thumb');
    	
    	$url = explode(',',$post);
		$pathname='./public/uploads/avatar/'.time().".gif"; 				
		$info = file_put_contents($pathname, base64_decode($url[1]));
        if($info){
        	return ['msg'=>'上传成功！','status'=>1,'data'=>$pathname];
        }else{
            return ['msg'=>'上传失败','status'=>2];          
        }


    }
        
}