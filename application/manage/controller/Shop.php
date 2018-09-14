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
use think\Db;
use think\helper\Time;
class Shop extends Auth
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view();
    }
    public function shoplist($limit,$page)
    {
    	list($start, $end) = Time::month();
    	$fristlimit=($page-1)*$limit;
		$count=model('Shoper')->count();
    	$list=model('Shoper')->limit($fristlimit,$limit)->select();
    	
    	foreach($list as $k=>$v){
    		if($v['endtime']<time()){
    			$list[$k]['notice']="过期";
    		}else if($v['endtime']>$start && $v['endtime']<$end){
    			$list[$k]['notice']="<font color='red'>即将到期</font>";
    		}else{
    			$list[$k]['notice']="<font color='green'>正常使用</font>";
    		}
    		$st=toDate(1,$v['starttime'],'Y-m-d');
    		$et=toDate(1,$v['endtime'],'Y-m-d');
    		$list[$k]['start-time']=$st;
    		$list[$k]['end-time']=$et;
    		$list[$k]['mess']="网站续费通知:-->".$v['realname']."您好！网站（".$v['url']."）将于".$et."日到期，续费金额".$v['money']."元/年。请收到该短信后及时续费，以免到期网站关闭给你带来不必要的损失。-->彭毅（18798075208）-->".date('Y-m-d',time())."";
    	};
    	//dump($list);
		$data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
        echo json_encode($data);
    }
    
    public function getmoney($id)
    {
       $table=input('table');
   		$res=db($table)->where('id',$id)->value('endtime');
   		
		$t=strtotime("+1 year", $res);
   		Db::name($table) ->where('id',$id)->update(['endtime'=>$t]);
   		if(false===$res){
   			$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
   		}else{
   		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>''];
   		}
       return $back;
    }
     public function alldel($data)
    {
    	$id=array_column($data,'id');
    	  $table=input('table');
       	$res=db($table)->delete($id);
       	if(false===$res){
       		$back=['msg'=>'操作失败！','status'=>2,'icon'=>5,'url'=>''];
       	}else{
       		$back=['msg'=>'操作成功！','status'=>1,'icon'=>6,'url'=>url('shop/index')];
       	}
    	
       return $back;
    }
   

}
