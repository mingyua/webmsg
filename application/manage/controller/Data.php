<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;
use think\Db;
use PHPExcel_IOFactory;
use PHPExcel;
use think\facade\Session;
use \tp5er\Backup;
class Data extends Controller
{
	
	public function initialize(){
		$config=array(
	        'path'     => './Data/',//数据库备份路径
	        'part'     => 20971520,//数据库备份卷大小
	        'compress' => 0,//数据库备份文件是否启用压缩 0不压缩 1 压缩
	        'level'    => 9 //数据库备份文件压缩级别 1普通 4 一般  9最高
	    );
		
		$this->db= new Backup($config);
	
	}
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {    	
    	$page=input('page');//当前页码
    	$table=input('table');//当前页码
    	$pagesize='100';//每页显示条数
		if(isset($page)){
	       	$files=Session::get('files');
			$excel = new \PHPExcel(); 
			//dump($res=$excel->read($files,"UTF-8",'xls','31',$pagesize));die(); 
		    $res=$excel->read($files,"UTF-8",'xls',$page,$pagesize);//传参,
			$totalpage=ceil($res['count']/$pagesize);//总页数		
			$percent=ceil(($page/$totalpage)*100) ."%";
	        $this->assign('count',$totalpage);
	        $this->assign('percent',$percent);
	        $this->assign('page',$page);	
	        $this->assign('table',$table);	
	        if($page==1){
	        	$data=array_splice($res['data'],1);
	        	$header=$res['data'][0];
	        	Session::set('header',$header);
	        	$newdata=[];
	        	foreach($data as $k=>$v){
	        		foreach($v as $a=>$b){
	        			$newdata[$k][$header[$a]]=$b;
	        		}
	        		
	        	}	      	         	
	        }else{
	        	$header=Session::get('header');
	        	$data= $res['data'];
	        	$newdata=[];
	        	
	        	foreach($data as $k=>$v){
		        		foreach($v as $a=>$b){
		        			if(strlen($v[1])>0){		        			
		        			$newdata[$k][$header[$a]]=$b;
		        			}		        			
		        		}
	        	}
	        	
	        }	        
	       $result=Db::name($table)->insertAll($newdata, true);	
	       if(false===$result){
	       		$this->assign('status',0);
	       }else{
				if($page<$totalpage){
			        $this->assign('status',1);
				}else if($page==$totalpage){
					$this->assign('status',2);
				}
	       	
	       }					
	       
			
		}
		
			$this->assign('success',input('status'));
	        return view();
			
		
    }

	public function backup(){
		
		return view();
	}
	public function backlist(){
		$data=$this->db->dataList();
		
		foreach($data as $k=>$v){
			$data[$k]['data_length']=unit($v['data_length']);
		}
        $backlist=['code'=>0,'msg'=>'','count'=>'0','data'=>$data];
        echo json_encode($backlist);
	}
  
  public function repair(){
  		
  		$tables=input('name');
  	
  		$res=$this->db->repair($tables);
  		if($res[0]['Msg_text']=='OK'){
  			$back=['msg'=>'修复成功','status'=>1,'icon'=>1,'url'=>''];
  		}else{
  			$back=['msg'=>'修复失败,请重试','status'=>2,'icon'=>5,'url'=>''];
  		}  		
  	 return $back; 	
  }  	
  public function optimize(){
  		
  		$tables=input('name');
  	
  		$res=$this->db->optimize($tables);
  		//dump($res);die();
  		if($res[0]['Msg_text']=='OK' || $res[0]['Msg_text']=='Table is already up to date'){
  			$back=['msg'=>'优化成功','status'=>1,'icon'=>1,'url'=>''];
  		}else{
  			$back=['msg'=>'优化失败,请重试','status'=>2,'icon'=>5,'url'=>''];
  		}  		
  	 return $back; 	
  }  	
   public function beifen(){
  		$input=input('name');

  		$tables=input('name');
		$res= $this->db->setFile()->backup($tables, 0); 	
  		
  		//dump($res);die();
  		if(false!==$res){
  			$back=['msg'=>'备份成功','status'=>1,'icon'=>1,'url'=>''];
  		}else{
  			$back=['msg'=>'备份失败,请重试','status'=>2,'icon'=>5,'url'=>''];
  		}  		
  	 return $back; 	
  }     
  
  public function import(){
  	$list=$this->db->fileList();
	foreach($list as $k=>$v){
		$list[$k]['size']=unit($v['size']);
		$list[$k]['name']=date('Ymd',$v['time']).$v['compress'].date('His',$v['time']).$v['compress'].$v['part'];
		$list[$k]['time']=date('Y-m-d H:i:s',$v['time']);
	}
	$list=array_sort($list,'time','desc');
	
  	$this->assign('list',$list);
  	//dump($list);
  	
  	      //return $this->fetch('importlist',['list'=>$db->fileList()]);
  	return view();
  }
    
}
