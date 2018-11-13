<?php
return [
    'type'         => 'Think',
    'auto_rule'    => 1,
    'view_path'    => './template/home/',
    'view_suffix'  => 'html',
    'view_depr'    => "_",
    'tpl_begin'    => '{',
    'tpl_end'      => '}',
    'taglib_begin' => '{',
    'taglib_end'   => '}',
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
