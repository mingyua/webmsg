<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------



return [
    '/'=>'home/index/index',
    'about-:cid'=>'home/about/index',
    'download-:catId'=>'home/download/index',
    'services-:catId'=>'home/services/index',
    'servicesInfo-:catId-[:id]'=>'home/services/info',
    'system-:catId'=>'home/system/index',
    'news-:cid'=>'home/news/index',
    'product-:cid'=>'home/product/index',
    'newsInfo-:catId-[:id]'=>'home/news/info',
    'team-:cid'=>'home/team/index',
    'contact-:catId'=>'home/contact/index',
    'senmsg'=>'home/index/senmsg',
    'down-:id'=>'home/download/down',
];
	

//Route::rule('about','home/about/index')->ext('html');
//Route::rule('about-:id','home/about/index')->ext('html')->name('about_read');
