<?php
namespace think;
define('APP_PATH', __DIR__ . '/application/');
define('SITEURL','http://c.com/');
// 加载基础文件
require __DIR__ . '/thinkphp/base.php';
// 执行应用并响应
Container::get('app',[APP_PATH])->bind('worker/Sendmsg/index')->run()->send();
