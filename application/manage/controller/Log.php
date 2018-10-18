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
class Log extends Auth
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {


		$Ip = new IpLocation(); // 实例化类
		$location = $Ip->getlocation('118.178.84.58');  		
		$data['uid']='1';
		$data['kinds']='1';
		$data['tag']='1';
		$data['ip']=$location['ip'];
		$data['address']=$location['country'];
		$data['network']=$location['area'];
        
//      $log=new Logs;
//      $log->save($data);
        return view();
    }
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function loglist($page,$limit)
    { 
    	$fristlimit=($page-1)*$limit;
    	
    	
    	$count=Logs::field('*')->count();   
        $list=db('log')->alias('A')->join('user B','A.uid=B.id')->field('A.*,B.username')->limit($fristlimit,$limit)->order('addtime DESC')->select();
        $menulist=['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
		//dump($menulist);
        echo json_encode($menulist);
        
    }
    public function alldel($data)
    {
    	$id=array_column($data,'addtime');
		$time=[];
		foreach($id as $k){
			$time=strtotime($k);
		}
       	$res=db('log')->delete($time);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('log/index')];
       	}
    	
       return $back;
    }

}
