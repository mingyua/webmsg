<?php
namespace app\manage\controller;
use think\Controller;
use think\Db;
class Upload extends Controller
{
    public function index()
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
}