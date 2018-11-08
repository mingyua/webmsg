<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;

class Urlbutty extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
		//dump($text);    	
		return view();
    }
    public function urllist()
    {
        $files=file_get_contents('./route/route.php');
		$text=preg_replace('/\<\?php|return\[|\];|(\s*)|(\')/i', '', $files);
		$data=toArr(trim($text,','),',');
		$list=[];
		foreach($data as $k=>$v){
			$arr=toArr($v,'=>');
			$list[$k]['urlname']=$arr[0];
			$list[$k]['route']=$arr[1];
		}		
        $urllist=['code'=>0,'msg'=>'','count'=>count($list),'data'=>$list];
        echo json_encode($urllist);        
		
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
    	if($this->request->post()){
    		$post=$this->request->post();
			
			$content='<?php'.PHP_EOL.'return['.PHP_EOL;
			foreach($post['data'] as $k=>$v){
				$name=preg_replace('/(\s*)/i', '', $v['urlname']);
				$route=preg_replace('/(\s*)/i', '', $v['route']);
			if(strlen($name)<=30){
				$flag=str_repeat(' ',30 - strlen($name));
			}else{
				$flag='';
			}
				
				$content .="	'".$name."'".$flag."=>	'".$route."',".PHP_EOL;
			}
			$content .='];';
    	}
		file_put_contents('./route/route.php', $content);
    	$back=['msg'=>'保存成功','status'=>'1','url'=>''];
        return $back;
    }
	
    public function addroute($urlname,$route)
    {
		$name=preg_replace('/(\s*)/i', '', $urlname);
		$route=preg_replace('/(\s*)/i', '', $route);    	
        $files=file_get_contents('./route/route.php');
		$text=preg_replace('/\];/i', '', $files);
		$text .="'".$name."'=>'".$route."',".PHP_EOL."];";
		file_put_contents('./route/route.php', $text);
     	$back=['msg'=>'保存成功','status'=>'1','url'=>''];
        return $back;
        
    }

    public function delete($id)
    {
    	$id=$id.",";
		$content='<?php'.PHP_EOL.'return['.PHP_EOL;
        $files=file_get_contents('./route/route.php');
		$text=preg_replace('/\<\?php|return\[|\];|(\s*)/i', '', $files);
		$content .=str_replace($id, '', $text);
		$content .='];';
    	file_put_contents('./route/route.php', $content);
     	$back=['msg'=>'删除成功','status'=>'1','url'=>''];
        return $back;       	   
    }
}
