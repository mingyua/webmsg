<?php
return[
	'/'                             =>	'home/index/index',
	'about'                         =>	'home/about/index?catId=1',
	'about-:catId'                  =>	'home/about/index',
	'contact-:catId'                =>	'home/contact/index',
	'down-:id'                      =>	'home/download/down',
	'download-:catId'               =>	'home/download/index',
	'news'                          =>	'home/news/index?catId=6',
	'news-:catId'                   =>	'home/news/index',
	'newsInfo-:catId-[:id]'         =>	'home/news/show',
	'product-:catId'                =>	'home/product/index',
	'senmsg22'                      =>	'home/index/senmsg22',
	'services-:catId'               =>	'home/services/index',
	'servicesInfo-:catId-[:id]'     =>	'home/services/info',
	'system-:catId'                 =>	'home/system/index',
	'team-:catId'                   =>	'home/team/index',
];