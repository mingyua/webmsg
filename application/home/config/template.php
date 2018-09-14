<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2018-2020 The MingYu                                   |
// +----------------------------------------------------------------------+
// | Authors: Original Author <285412937@qq.com>                          |
// |          MingYu <285412937@qq.com>                                   |
// +----------------------------------------------------------------------+


return [
    // 模板引擎类型 支持 php think 支持扩展
    'type'         => 'Think',
    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写 3 保持操作方法
    'auto_rule'    => 1,
    // 模板路径
    'view_path'    => './template/home/',
    // 模板后缀
    'view_suffix'  => 'html',
    // 模板文件名分隔符
    'view_depr'    => "_",
    // 模板引擎普通标签开始标记
    'tpl_begin'    => '{',
    // 模板引擎普通标签结束标记
    'tpl_end'      => '}',
    // 标签库标签开始标记
    'taglib_begin' => '{',
    // 标签库标签结束标记
    'taglib_end'   => '}',
    // 预先加载的标签库
    'taglib_pre_load'     =>    'app\common\taglib\PE',
    'tpl_replace_string'=> [
    	'__SITEURL__'=>'http://c.com/',
        '__ROOT__'     => '/',
        '__LAYUI__'     => '/public/layui',
        '__JS__'     => '/public/js',
        '__CSS__'    => '/public/css',
        '__PUBLIC__'    => '/public',
        '__IMAGES__'    => '/public/images',

    ],
];
