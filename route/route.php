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

Route::get('/','home/index/index');
Route::group(['method' => 'get', 'ext' => 'html'], function () {
    Route::rule('about', 'about/index');
    Route::rule('about-:id', 'about/index')->name('about_read');
})->pattern(['id' => '\d+', 'name' => '\w+']);	
	

//Route::rule('about','home/about/index')->ext('html');
//Route::rule('about-:id','home/about/index')->ext('html')->name('about_read');
return [
	
];
