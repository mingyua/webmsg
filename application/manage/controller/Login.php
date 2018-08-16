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
use Iplocation\IpLocation;
use mac\GetMacAddr;
use app\manage\model\Log as Logs;
class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
    	if($this->request->post()){
    		$post=$this->request->post();
    		
			if(!captcha_check($post['code'])){
			 	$back=['msg'=>'验证码不正确,请重新输入!','status'=>0];
			}else{
				$map[]=['username','eq',htmlentities($post['name'])];
				$map[]=['userpwd','eq',MD5(htmlentities($post['password']))];
				$user=db('user')->where($map)->find();
				
				if(isset($user)){
					if($user['status']==1){
				    	$mac= new GetMacAddr();
				    	$macc=$mac->GetMacAddr(PHP_OS);
						$Ip = new IpLocation(); // 实例化类
						$location = $Ip->getlocation();  			
						$data['uid']=$user['id'];
						$data['kinds']='1';
						$data['tag']=$user['username']."登录成功.";
						$data['mac']=$macc;
						$data['ip']=$location['ip'];
						$data['address']=$location['country'];
						$data['network']=$location['area'];	        
				        $log=new Logs;
				        $log->isUpdate(false)->save($data);
			        
						db('user')->where('id','eq',$user['id'])->update(['uptime'=>time()]);
						session('htuserid',$user['id']);
						session('htusername',$user['username']);
						session('htpwd',$user['userpwd']);
						session('htgid',$user['groupid']);
						session('htuptime',$user['uptime']);
						session('htaddtime',$user['addtime']);
						$back=['msg'=>'登录成功,正在跳转...','status'=>1,'url'=>URL('index/index')];
					}else{
						$back=['msg'=>'用户被禁用,请联系管理员!','status'=>0];
					}
				}else{
					$back=['msg'=>'用户名或密码错误!','status'=>0];
				}
				
			}
			return $back;
	    }else{
	    	if(session('htusername')){
	    		$this->redirect('index/index');
	    	}
	    	$mac= new GetMacAddr();
	    	$macc=$mac->GetMacAddr(PHP_OS);
			$Ip = new IpLocation(); // 实例化类
			$location = $Ip->getlocation();  
			
			$data['uid']='1';
			$data['kinds']='1';
			$data['tag']='1';
			$data['mac']=$macc;
			$data['ip']=$location['ip'];
			$data['address']=$location['country'];
			$data['network']=$location['area'];
 


	   		return $this->fetch();
	   }
    	
        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function loginout()
    {
       
       session('htusername', null);
       $this->redirect('login/index');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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
