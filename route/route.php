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

Route::rule('news','home/news/index?catId=6');
Route::rule('about','home/about/index?catId=1');

return [
    '/'=>'home/index/index',
    'about-:catId'=>'home/about/index',
    'download-:catId'=>'home/download/index',
    'services-:catId'=>'home/services/index',
    'servicesInfo-:catId-[:id]'=>'home/services/info',
    'system-:catId'=>'home/system/index',
    'news-:catId'=>'home/news/index',
    'product-:catId'=>'home/product/index',
    'newsInfo-:catId-[:id]'=>'home/news/show',
    'team-:catId'=>'home/team/index',
    'contact-:catId'=>'home/contact/index',
    'senmsg'=>'home/index/senmsg',
    'down-:id'=>'home/download/down',
];
	

//Route::rule('about','home/about/index')->ext('html');
//Route::rule('about-:id','home/about/index')->ext('html')->name('about_read');
