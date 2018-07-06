<?php
namespace app\index\controller;
use think\Controller;
use think\helper\Time;
class Index extends Controller
{
	 protected function initialize()
    {
    	$this->uid=session('uid');
//		$this->view->filter(function($content){
//      	return str_replace("\r\n",'',$content);
//      });    	
    	
    }
	
    public function index()
    {
   	$this->assign('uid',session('uid'));
        if(empty($this->uid)){
        	$this->redirect('index/login');
        }
		
		return $this->fetch();
    }
    public function login()
    {
    	if($this->request->post()){
    		$post=$this->request->post();
    		if(isset($post['username'])){
    			session('uid',$post['username']);
    			$this->redirect('index/index');
    		}
    	}else{
    		return $this->fetch();
    	}
		
		
		
    }

  	public function send(){
  	  	//权限控制，不通过则die();	
		 $to_uid = "";
		// 推送的url地址，使用自己的服务器地址
		$push_api_url = "http://c.com:9191/";
		$post_data = array(
		   "type" => "publish",
		   "msg" => "这个是推送的测试数465465465据 uid=".$to_uid,
		   "to" => $to_uid, 
		);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $push_api_url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
		curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Expect:"));
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		var_export($return);
    }

}
