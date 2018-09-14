<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function getconfigfield($field){
	$arr=db('config')->cache('config',0)->select();
	$data=[];
	foreach($arr as $k=>$v){
		$data[$v['key']]=$v['value'];
	}
	return $data[$field];
}

/*
 * fieldhtml 返回对应类型的表单代码
 * $arr 数据
 * 
 */
function fieldhtml($arr){
	$html='';
	foreach($arr as $k=>$v){
		if($v['tip']){ $tip='<div class="layui-form-mid layui-word-aux">'.$v['key'].':'.$v['tip'].'</div>'; }else{ $tip='<div class="layui-form-mid layui-word-aux">'.$v['key'].':</div>'; }
		if(strlen($v['width'])>0){ $width='class="layui-input-inline" style="width:'.$v['width'].'"'; }else{ $width='class="layui-input-block"'; }
		
		switch($v['type']){
			case 'text':
		  	$html .= '<div class="layui-form-item"><label class="layui-form-label">'.$v['name'].'</label><div '.$width.'><input name="'.$v['key'].'" value="'.$v['value'].'" placeholder="'.$v['placeholder'].'" class="layui-input" type="text"></div>'.$tip.'</div>';		  	
			break; 
			case 'textarea':
		  	$html .= '<div class="layui-form-item layui-form-text"><label class="layui-form-label">'.$v['name'].'</label><div '.$width.'><textarea name="'.$v['key'].'" placeholder="'.$v['placeholder'].'" class="layui-textarea">'.$v['value'].'</textarea></div>'.$tip.'</div>';		  	
			break; 
			case 'file':
			if($v['value']){
				$img=trim($v['value'],'.');
			}else{
				$img="/public/manage/images/upload.png";
			}

		  	$html .= '<div class="layui-form-item layui-form-text"><label class="layui-form-label">'.$v['name'].'</label><div '.$width.'><a class="demoMore" lay-data="{url:\'/manage/upload/index\'}"><img src="'.$img.'" width="100%" /></a><input type="hidden" name="'.$v['key'].'" value="'.$v['value'].'"></div>'.$tip.'</div>';		  	
			break; 
			

		}
	}
	 echo $html;
	
}

function catechannel($arr,$pid=0,$level=0){
	$Tree=[];
	foreach($arr as $k=>$v){
		if($v['pid']==$pid){			
			$v['level']=$level;
			$v['children']=catechannel($arr,$v['id'],$level+1);
			$Tree[]=$v;
		}	
	}
	return $Tree;	
}
/*
 * menuTree 菜单无限分类树形结构
 * $pid  父级ID
 * $field  比较字段
 * $html  追加字符
 * $level  层级关系
 */
function menuTree($arr,$pid=0,$level=0,$html="&nbsp;&nbsp;&nbsp;&nbsp;"){
	static $Tree=[];
	foreach($arr as $k=>$v){
		if($v['pid']==$pid){			
			$flg = str_repeat($html,$level);
			if($level==0){
				$v['catename']=$flg.$v['name'];
			}else{
				$v['catename']=$flg."└--------".$v['name'];
			}
			$v['level']=$level;
			$v['_html']=$flg;
			
			$Tree[]=$v;
			menuTree($arr,$v['id'],$level+1,$html);
		
		}	
	}
	return $Tree;	
}

/*
 * menuTree 菜单无限分类层级结构
 * $pid  父级ID
 * $level  层级关系
 */
function getchildren($arr,$pid=0,$level=0){
	$Tree=[];
	foreach($arr as $k=>$v){
		if($v['pid']==$pid){									
			$v['children']=getchildren($arr,$v['id'],$level+1);
			//url处理
			if(strlen($v['url'])>3){
				$v['url']=url($v['url']);
			}
			$Tree[]=$v;		
		}	
	}
	return $Tree;
	
}


/*
 * 知道任意id返回所有主父级和子级ID
 * @$array 是表所有数据
 * 
 */
function getprentsid($array,$id){
    $arr = array();
    foreach($array as $v){    	
	        if($v['id'] == $id){
	            //$arr[] = $v['pid'];
	            if($v['pid']==0){
	            	$arr[] = $v['id'];
	            }
	             $arr=array_merge($arr,getprentsid($array,$v['pid'])); 
	        };
       
    };
    return $arr;
}

function get_all_child($array,$id){
    $arr = array();
    foreach($array as $v){
        if($v['pid'] == $id){
            $arr[] = $v['id'];
            $arr = array_merge($arr,get_all_child($array,$v['id']));
        };
    };
    return $arr;
}
/*
 * 更新所有分类子类id
 * @$array 是表所有数据
 * $field 要更新的字段
 */
function allupdata($array,$field){
    	$data=[];
    	foreach($array as $k=>$v){
    		$data[$k]['id']=$v['id'];
    		$allchild=get_all_child($array,$v['id']);
    		$arrid=array_merge($allchild,array($v['id']));
    		sort($arrid);
    		$childrenid=implode(',',$arrid);
    		$data[$k][$field]=$childrenid;
    	}		
    	return $data;
}

/*
*日期转化  
* $type 1:转化为时间类型，2转化为时间戳
* $time 时间或时间戳
* $format 时间格式
*/
function toDate($type=1,$time='',$format='Y-m-d H:i:s'){
	
	if($type==1){
		return date($format,$time);
	}else if($type==2){
		return strtotime($time);
	}else{
		return date($format,time());
	}
}
/*
 *字符串转数组 
 * 
 * 
 */
function toArr($text,$tag=',',$pos=null){
	$arr=explode($tag,$text);
	if(isset($pos)){
		return $arr[$pos];
	}else{
		return $arr;
	}
	
}
/*
 *数组排序 
 * $arr 要排序的数组
 * $keys 以什么字段排序
 * $type 排序方式默认升序
 */
function array_sort($arr,$keys,$type='asc'){ 
	 $keysvalue = $new_array = array();
	 foreach ($arr as $k=>$v){
	  $keysvalue[$k] = $v[$keys];
	 }
	 if($type == 'asc'){
	  asort($keysvalue);
	 }else{
	  arsort($keysvalue);
	 }
	 reset($keysvalue);
	 foreach ($keysvalue as $k=>$v){
	  $new_array[$k] = $arr[$k];
	 }
	 return $new_array; 
}

/*
 * 向数组中添加元素
 * 
 * 
 */
function addarr($arr,$field='id',$val=1){

	foreach($arr as $k=>$v){
		$arr[$k][$field]=$val;

	}
	return $arr;
}

/*
 * 保留小数位数
 * $num 要保留的的数字
 * $len 保留位数
 * $type 保留类型    四舍五入  round 不补0  number_format 补0 ceil向上取事整   floor向下取整
 */
function savenum($num,$len=2,$type='round'){ 
	if($type=='ceil' || $type=='floor'){
		return $type($num);
	}else{
		return $type($num,$len);
	}		
}  
/*
 * MB <=> KB <=> B 单位换算
 * $bit 字节
 * $len 保留位数
 * $type 保留类型    四舍五入  round 不补0  number_format 补0 ceil向上取事整   floor向下取整
 */
function unit($bit,$unit='KB'){
	
	$str=round($bit/1024,2);
	if($str>=1024){
		$unit='MB';
		$str=round($str/1024,2);
	}
	return $str." ".$unit;
}	
/**
 * 递归实现删除目录下的所有的文件和文件夹
 * @param $dir 要删除的目录
 * @param bool $deleteRootToo 是否删除根目录 默认不删除
 http://www.manongjc.com/article/1333.html
 */
function clearCache($dir, $deleteRootToo = false)
{
    if(!$dh = @opendir($dir))
    {
        return 0;
    }
    while (false !== ($obj = readdir($dh)))
    {
        if($obj == '.' || $obj == '..')
        {
            continue;
        }
        if (!@unlink($dir . '/' . $obj))//删除文件, 如果是目录则返回false
        {
            clearCache($dir.'/'.$obj, true);
        }
    }
    
    closedir($dh);
    if ($deleteRootToo)
    {
        @rmdir($dir);//删除目录
    }
    return;
}

function dyconfig($getname,$pos){
	$array=[
		'hookkinds'=>[['id'=>1,'name'=>'图片轮播'],['id'=>2,'name'=>'友情链接'],['id'=>3,'name'=>'在线客服']],
		'tempcate'=>[['id'=>1,'name'=>'单页'],['id'=>2,'name'=>'列表']],
	];
	if(isset($pos)){
		return $array[$getname][$pos];
	}else{
		return $array[$getname];
	}
	
}

function addtext($text,$addword){
	return $text.$addword;
}

//加密函数
function lock_url($txt,$key='mingyu')
{
  $txt = $txt.$key;
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
  $nh = rand(0,64);
  $ch = $chars[$nh];
  $mdKey = md5($key.$ch);
  $mdKey = substr($mdKey,$nh%8, $nh%8+7);
  $txt = base64_encode($txt);
  $tmp = '';
  $i=0;$j=0;$k = 0;
  for ($i=0; $i<strlen($txt); $i++) {
    $k = $k == strlen($mdKey) ? 0 : $k;
    $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
    $tmp .= $chars[$j];
  }
  return urlencode(base64_encode($ch.$tmp));
}
//解密函数
function unlock_url($txt,$key='mingyu')
{
  $txt = base64_decode(urldecode($txt));
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
  $ch = $txt[0];
  $nh = strpos($chars,$ch);
  $mdKey = md5($key.$ch);
  $mdKey = substr($mdKey,$nh%8, $nh%8+7);
  $txt = substr($txt,1);
  $tmp = '';
  $i=0;$j=0; $k = 0;
  for ($i=0; $i<strlen($txt); $i++) {
    $k = $k == strlen($mdKey) ? 0 : $k;
    $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
    while ($j<0) $j+=64;
    $tmp .= $chars[$j];
  }
  return trim(base64_decode($tmp),$key);
}