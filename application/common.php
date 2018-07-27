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
/*
 * fieldhtml 返回对应类型的表单代码
 * $arr 数据
 * 
 */

function fieldhtml($arr){
	$html='';
	foreach($arr as $k=>$v){
		if($v['tip']){ $tip='<div class="layui-form-mid layui-word-aux">'.$v['tip'].'</div>'; }else{ $tip=''; }
		if(strlen($v['width'])>0){ $width='class="layui-input-inline" style="width:'.$v['width'].'"'; }else{ $width='class="layui-input-block"'; }
		switch($v['type']){
			case 'text':
		  	$html .= '<div class="layui-form-item"><label class="layui-form-label">'.$v['name'].'</label><div '.$width.'><input name="'.$v['key'].'" value="'.$v['value'].'" placeholder="'.$v['placeholder'].'" class="layui-input" type="text"></div>'.$tip.'</div>';		  	
			break; 
			case 'textarea':
		  	$html .= '<div class="layui-form-item layui-form-text"><label class="layui-form-label">'.$v['name'].'</label><div '.$width.'><textarea name="'.$v['key'].'" placeholder="'.$v['placeholder'].'" class="layui-textarea">'.$v['value'].'</textarea></div>'.$tip.'</div>';		  	
			break; 
			case 'file':
		  	$html .= '<div class="layui-form-item layui-form-text"><label class="layui-form-label">'.$v['name'].'</label><div '.$width.'><a class="layui-btn uploadbg demoMore" lay-data="{url:\'/manage/upload/index\'}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><input type="hidden" name="'.$v['key'].'" value="'.$v['value'].'"></div>'.$tip.'</div>';		  	
			break; 
			

		}
	}
	 echo $html;
	
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
				$v['catename']=$flg."└".$v['name'];
			}
			$v['level']=$level;
			
			$Tree[]=$v;
			menuTree($arr,$v['id'],$level+1,$html);
		
		}	
	}
	return $Tree;
	
}

/**
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

/**
 * menuTree 菜单无限分类层级结构
 * $pid  父级ID
 * $level  层级关系
 */
function getchildrenId($arr,$id){
	static $Tree='';
	foreach($arr as $k=>$v){
		if($v['pid']==$id){	
			$Tree .=$v['id'].",";									
			getchildrenId($arr,$v['id']);				
		}		
	}
	$res=explode(',',$Tree.$id);
	
	return $res;
	
}

/*
 * 字符重复次数
 */
function strrpt($str,$count){
	$data=str_repeat($str,$count);
	return $data;
}


