<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace app\common\taglib;
use think\template\TagLib;
use think\Db;
/**
 * CX标签库解析类
 * @category   Think
 * @package  Think
 * @subpackage  Driver.Taglib
 * @author    liu21st <liu21st@gmail.com>
 */
class PE extends TagLib{

    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        '_list'        => ['attr' => 'table,where,sql,field,order,limit,id,empty,page'],
        '_getval'	   => ['attr'=>'name,table,where,sql,field,order,cache','close' => 0],
        '_nav'	   	   => ['attr'=>'name,table,where,sql,field,order,cache,id,empty'],
        //'volist'     => ['attr' => 'name,id,offset,length,key,mod', 'alias' => 'iterate'],
       // 'foreach'    => ['attr' => 'name,id,item,key,offset,length,mod', 'expression' => true],
        //'if'         => ['attr' => 'condition', 'expression' => true],
    ];

    /**
     * _list标签解析 循环输出数据集
     * 格式：
     * {PE:_list table="article" where="" field="*" order="id desc" limit="12" id="v"}
     * {v.title}
     * {/PE:_list}
     * 	{PE:_list table="menu" where="[['id','gt','0'],['status','eq',1]]" id="v" page="true" limit="1" empty="没有数据"}
	 *	{$v.name,'<Br>'|addtext|raw}
	 *	{/PE:_list}
	 *  <p>{$page|raw}</p> 
     * @access public
     * @param  $where 直接写成[['id','gt',1],['status','eq',0]]
     * @param  array $tag 标签属性
     * @param  string $content 标签内容
     * @return string|void
     */
    public function tag_list($tag, $content)
    {
        $table   = $tag['table'];
		$empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $where   = isset($tag['where'])?$tag['where']:'1';
        $field   = isset($tag['field'])?$tag['field']:'*';
        $order   = isset($tag['order'])?$tag['order']:'id DESC';
        $limit   = isset($tag['limit'])?$tag['limit']:'10';
        $sql     = isset($tag['sql'])?$tag['sql']:'';
        $id     = isset($tag['id'])?$tag['id']:'v';
        $page     = isset($tag['page'])?$tag['page']:false;
        
        
		$parseStr='<?php $m=Db("'.$table.'");';
		if($sql){
			$parseStr .='$res=Db::query("'.$sql.'");';
		}else{	
			$parseStr .='$map='.$where.';';		
			
			if(!$page){
				$parseStr .='$res=$m->where($map)->field("'.$field.'")->order("'.$order.'")->limit("'.$limit.'")->select();';
			}else{
				$parseStr .='$res=$m->where($map)->field("'.$field.'")->order("'.$order.'")->paginate('.$limit.');';
				$parseStr .='$page = $res->render();';				
			}		

		}
		$parseStr .= 'if( count($res)==0 ) : echo "'.$empty.'" ;';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($res as $k=>$'.$id.'): ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endforeach; endif; ?>';
		//$parseStr .='dump($res);';
        if (!empty($parseStr)) {
            return $parseStr;
        }

        return;
    }
    /**
     * _getval标签是闭合标签
     * 格式：
	 *	{PE:_getval table='article' where="[['id','eq',8]]" name="site" cache="art,0" /}
	 *	{$site.title}
     * @access public
     * @param  $where 直接写成[['id','gt',1],['status','eq',0]]
     * @param  array $tag 标签属性
     * @param  string $content 标签内容
     * @return string|void
     */
    public function tag_getval($tag)
    {
		$table   = $tag['table'];
        $name   = isset($tag['name'])?$tag['name']:'info';
        $where   = isset($tag['where'])?$tag['where']:'1';
        $field   = isset($tag['field'])?$tag['field']:'*';
        $order   = isset($tag['order'])?$tag['order']:'id DESC';
        $cache     = isset($tag['cache'])?$tag['cache']:false;
		$parseStr='<?php $m=Db("'.$table.'");';
		if($cache){
			$parseStr .='$'.$name.'=$m->where('.$where.')->field("'.$field.'")->order("'.$order.'")->cache("'.$cache.'")->find();';
		}else{	
			$parseStr .='$'.$name.'=$m->where('.$where.')->field("'.$field.'")->order("'.$order.'")->find();';
		}
		$parseStr .='?>';
		
		return $parseStr;
		
	}
    /**
     * _nav标签
     * 格式：
	 *	{PE:_getval table='article' where="[['id','eq',8]]" name="site" cache="art,0" /}
	 *	{$site.title}
     * @access public
     * @param  $where 直接写成[['id','gt',1],['status','eq',0]]
     * @param  array $tag 标签属性
     * @param  string $content 标签内容
     * @return string|void
     */
    public function tag_nav($tag,$content)
    {
		$table   = $tag['table'];
		$empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $name   = isset($tag['name'])?$tag['name']:'info';
        $sql     = isset($tag['sql'])?$tag['sql']:'';
        $where   = isset($tag['where'])?$tag['where']:'1';
        $field   = isset($tag['field'])?$tag['field']:'*';
        $order   = isset($tag['order'])?$tag['order']:'id DESC';
        $cache     = isset($tag['cache'])?$tag['cache']:false;
        $id     = isset($tag['id'])?$tag['id']:'v';        
		$parseStr='<?php $m=Db("'.$table.'");';
		if($sql){
			$parseStr .='$res=Db::query("'.$sql.'");';
		}else{	
			$parseStr .='$map='.$where.';';		
			$parseStr .='$res=$m->where($map)->field("'.$field.'")->order("'.$order.'")->cache('.$cache.')->select();';
		}
		$parseStr .= 'if( count($res)==0 ) : echo "'.$empty.'" ;';
        $parseStr .= 'else: ';
        $parseStr .= '$data=catechannel($res);';
        $parseStr .= 'foreach($data as $k=>$'.$id.'): ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endforeach; endif; ?>';
        if (!empty($parseStr)) {
            return $parseStr;
        }

        return;		
	}
}
