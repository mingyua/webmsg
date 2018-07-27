<?php

namespace app\manage\controller;

use think\Controller;
use think\Request;
use think\Db;
use PHPExcel_IOFactory;
use PHPExcel;
use think\facade\Session;
class Data extends Controller
{
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

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function import($page)
    {
       return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function insert($page)
    {
		return ['status'=>1,'page'=>$page+1,'url'=>url('data/insert')];       //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
       	$files=Session::get('files');
		$excel = new \PHPExcel();  
	    $res=$excel->read($files,"UTF-8",'xls',$page,'100');//传参,
	     
	    if($res){
			echo "第".$page."页，插入100条数据成功！";     
	    	sleep(2);
	    	$this->redirect('data/import', ['page'=>$page+1]);
	    }  	
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
