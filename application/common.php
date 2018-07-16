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
function fieldhtml($arr){
	$html='';
	foreach($arr as $k=>$v){
		switch($v['type']){
			case 'text':
		  	$html .= '<div class="layui-form-item"><label class="layui-form-label">'.$v['name'].'</label><div class="layui-input-block"><input name="'.$v['key'].'" value="'.$v['value'].'" placeholder="'.$v['placeholder'].'" class="layui-input" type="text"></div></div>';		  	
			break; 
			case 'textarea':
		  	$html .= '<div class="layui-form-item layui-form-text"><label class="layui-form-label">'.$v['name'].'</label><div class="layui-input-block"><textarea name="'.$v['key'].'" placeholder="'.$v['placeholder'].'" class="layui-textarea">'.$v['value'].'</textarea></div></div>';		  	
			break; 
			case 'file':
		  	$html .= '<div class="layui-form-item layui-form-text"><label class="layui-form-label">'.$v['name'].'</label><div class="layui-input-block"><a class="layui-btn uploadbg demoMore" lay-data="{url:\'upload/index\'}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div></div>';		  	
			break; 
			

		}
	}
	 echo $html;
	
}
