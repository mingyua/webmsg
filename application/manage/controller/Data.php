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
use PHPExcel_IOFactory;
use PHPExcel;
use think\facade\Session;
use \tp5er\Backup;
class Data extends Auth
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

    public function backup()
    {

      $data=$this->db->dataList();

      $this->assign('list',$data);
      return view();
    }
    public function backuplist()
    {

      $data=$this->db->dataList();
	  foreach($data as $k=>$v){
	  	 $data[$k]['data_length']=unit($v['data_length']);
	  }
        $datalist=['code'=>0,'msg'=>'','count'=>'','data'=>$data];
        echo json_encode($datalist);      }
   //备份文件列表
   public function importlist()
   {
   		$list=$this->db->fileList();
   		$data=array_sort($list,'compress');
      	$this->assign('list',$data);
      return view();
        
      
   }
   public function import($time = 0, $part = null, $start = null)
   {
       if(is_numeric($time) && is_null($part) && is_null($start)){
           $list  = $this->db->getFile('timeverif',$time);
           if(is_array($list)){
               session::set('backup_list', $list);
               $this->success('初始化完成！', '', array('part' => 1, 'start' => 0));
           }else{
               $this->error('备份文件可能已经损坏，请检查！');
           }
       }else if(is_numeric($part) && is_numeric($start)){

               $list=session::get('backup_list');
               
               $start= $this->db->setFile($list)->import($start);
              
               if( false===$start){
                     $this->error('还原数据出错！');
               }elseif(0 === $start){
                   if(isset($list[++$part])){
                       $data = array('part' => $part, 'start' => 0);
                       $this->success("正在还原...#{$part}", '', $data);
                   } else {
                       session::delete('backup_list');
                       //addlog();//写入日志
                       $this->success('还原完成！');
                   }
               }else{
                   $data = array('part' => $part, 'start' => $start[0]);
                   if($start[1]){
                       $rate = floor(100 * ($start[0] / $start[1]));
                       $this->success("正在还原...#{$part} ({$rate}%)", '', $data);
                   } else {
                       $data['gz'] = 1;
                       $this->success("正在还原...#{$part}", '', $data);
                   }
                   $this->success("正在还原...#{$part}", '');
                   
               }
           
           
       }else{
           $this->error('参数错误！');
       }

      
   }
   /**
    * 删除备份文件
    */
   public function del($id = 0){

       if($this->db->delFile($id)){
           //addlog($id);//写入日志
           $arr=array('msg'=>'备份文件删除成功!','result'=>1);
           
       }else{
       	$arr=array('msg'=>'备份文件删除失败，请检查权限!','result'=>2);
           
       }
       return json($arr);
   }


   //备份表
   public function export()
   {
       if($this->request->post()){
		   	$input=$this->request->post();
			$tables=[];
			foreach($input as $k=>$v){
				$tables[]=$k;
			}          
           $fileinfo  =$this->db->getFile();
           //检查是否有正在执行的任务
           $lock = "{$fileinfo['filepath']}backup.lock";
           if(is_file($lock)){
               $this->error('检测到有一个备份任务正在执行，请稍后再试！');
           } else {
               //创建锁文件
               file_put_contents($lock,time());
           }
           // 检查备份目录是否可写
           is_writeable($fileinfo['filepath']) || $this->error('备份目录不存在或不可写，请检查后重试！');

           //缓存锁文件
           session::set('lock', $lock);
           //缓存备份文件信息
           session::set('backup_file', $fileinfo['file']);
           //缓存要备份的表
           session::set('backup_tables',$tables);
           //创建备份文件
           if(false !== $this->db->Backup_Init()){
           		 $tab = array('id' => 0, 'start' => 0);
           	    return ['code'=>1,'msg'=>'初始化成功！','data' => $tab];
           }else{
               $this->error('初始化失败，备份文件创建失败！');
           }
       }else if($this->request->isGet()){
           $tables =  session::get('backup_tables');
           $file=session::get('backup_file');

           $id=input('id');
           $start=input('start');
           $start= $this->db->setFile($file)->backup($tables[$id], $start);
           if(false === $start){
               $this->error('备份出错！');
           }else if(0 === $start){
               if(isset($tables[++$id])){
                   $tab = array('id' => $id, 'start' => 0);
                  // addlog();//写入日志
                  return ['code'=>1,'msg'=>'备份完成！','data' => $tab];
                  // $this->success('备份完成！', '', array('tab' => $tab));
               } else { //备份完成，清空缓存
                   unlink(session::get('lock'));
                   Session::delete('backup_tables');
                   Session::delete('backup_file');
                  // addlog();//写入日志
                   return ['code'=>1,'msg'=>'备份完成！'];
               }
           }
       }else{
           $this->error('请选择要备份的数据表！');
       }


   }

   //修复表
   public function repair($tables= null)
   {
		   	$input=$this->request->post();
			$tables=[];
			foreach($input as $k=>$v){
				$tables[]=$k;
			}          

       if($this->db->repair($tables)){
           
           $arr=['msg'=>'数据表修复完成！'];
       }else{
          
           $arr=['msg'=>'数据表修复出错请重试！'];
       }
        return $arr;
   }
   //优化表
   public function optimize($tables= null)
   {
         if($this->db->optimize($tables)){
         	$arr=['msg'=>'数据表优化完成！'];
          
         }else{
         	$arr=['msg'=>'数据表优化出错请重试！'];
          
         }
          return $arr;
   }


	public function buildsql(){
		unlink('./sql.sql');
		$arr=db('article')->select();
		$i=0;
		foreach($arr as $k=>$v){
			$i++;			
			file_put_contents('./sql.sql',array_to_sql($v,'wb_article','insert',['id']).";".PHP_EOL, FILE_APPEND);	
		}
		if($i==count($arr)){
			echo "数据导出成功";
		}else{
			echo "数据导出中断,请重新导出!";
		}
	}  
	/*
	 * @ excsql 执行SQL
	 * 
	 * @ VAR  $start   开始执行位置,从第几条开始
	 * @var   $excnum  每次执行多少条
	 * 
	 */
	public function excsql($start=1,$excnum=1){								
		$data=readBigFileLines('./sql.sql',$start,$start+$excnum-1);
		foreach($data['content'] as $v){
			Db::execute($v);
		}
		//dump($data);
	} 
	/* $start  开始执行位置,从第几条开始------- 开始位置不能为0;如果为0没有数据会报错 所以DIE
	 * @var   $excnum  每次执行多少条
	 * 
	 */
   	public function progress($start=0,$excnum=800){
   		if($start==0){
   			$this->assign('start',1);
			return $this->fetch();
   			die();
   		}
   		$endLine=$start+$excnum;
		$data=readBigFileLines('./sql.sql',$start,$start+$excnum-1);
		dump(preg_replace('/[（）？]/isu', '', $data['content']));die();
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd"><html><head><title>动态显示服务器运行程序的进度条</title><meta http-equiv="Content-Type" content="text/html; charset=utf8"></head><script type="text/javascript">function addtext(t,j){document.getElementById("boxtext").innerHTML=document.getElementById("boxtext").innerHTML+t;}</script><body><div id="boxtext" style="display: block;width: 400px;height: 400px;overflow-x: hidden;background: #FFF;border: 1px solid #ccc;margin: auto auto;padding: 10px;"></div>';
		$i=0;
		foreach($data['content'] as $v){						
			$i++;$yu=$start++;
			if(true==Db::execute('insert into '.$v)){
				EshowMsg(3,'<div style="float:left;">第<font color="red">  '. $yu .'</font>条数据完成</div><div style="float:right;">余:'.($data['totalnum'] - $yu).'条</div>'); //显示程序进度	
				usleep(rand(10000, 12000));	
			}else{
				EshowMsg($start++,'中断...');
			}			
		}
		if($i=$excnum and ($data['totalnum']-$start)>0){
			EshowMsg(1,'正在跳转到下一个页面...');
			sleep(1);
			$jump=URL('data/progress',array('start'=>$endLine));
			echo "<script>window.location.href='".$jump."';</script>";
					
		}
		
        EshowMsg(1,'<center style="display:block;width:100%;color:green;font-size:24px;line-height:40px">(@_@)<br> 恭喜您！数据导入完成</center>');
   		
   		return $this->fetch();
	}
   
}