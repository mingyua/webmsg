<?php
namespace app\worker\controller;
use Workerman\Worker;
use Workerman\Lib\Timer;
use PHPSocketIO\SocketIO;
class Sendmsg 
{
  public function index(){
		// 全局数组保存uid在线数据
		$uidConnectionMap = array();
		// 记录最后一次广播的在线用户数
		$last_online_count = 0;
		// 记录最后一次广播的在线页面数
		$last_online_page_count = 0;        

		$io = new SocketIO(2021);
	 

		// 当有客户端连接时
		$io->on('connection', function($socket)use($io){
			
			$socket->on('login', function ($uid)use($socket){
		        global $uidConnectionMap, $last_online_count, $last_online_page_count;
		        // 已经登录过了
		        if(isset($socket->uid)){
		            return;
		        }
		        // 更新对应uid的在线数据
		        $uid = (string)$uid;
		        if(!isset($uidConnectionMap[$uid]))
		        {
		            $uidConnectionMap[$uid] = 0;
		        }
		        // 这个uid有++$uidConnectionMap[$uid]个socket连接
		        ++$uidConnectionMap[$uid];
		        // 将这个连接加入到uid分组，方便针对uid推送数据
		        $socket->join($uid);
		        $socket->uid = $uid;
		         $socket->emit('user',json_encode($uidConnectionMap));
		        // 更新这个socket对应页面的在线数据
		        $socket->emit('online_box', "当前<b>{$last_online_count}</b>人在线，共打开<b>{$last_online_page_count}</b>个页面");
		    });					
		    $socket->on('disconnect', function () use($socket) {
		    	
		        if(!isset($socket->uid))
		        {
		             return;
		        }
		        global $uidConnectionMap, $io;
		        // 将uid的在线socket数减一
		        if(--$uidConnectionMap[$socket->uid] <= 0)
		        {
		            unset($uidConnectionMap[$socket->uid]);
		        }
		    });
			
		  // 定义chat message事件回调函数		  
			  $socket->on('senmsg', function($msg)use($io,$socket){
			  	
			    // 触发所有客户端定义的chat message from server事件
			    $socket->broadcast->emit('tip', '你有新消息，请注意查收！');
			    $io->emit('senmsg from server', json_encode($msg));
			  });
		});
		// 监听一个http端口，通过http协议访问这个端口可以向所有客户端推送数据(url类似http://ip:9191?msg=xxxx)
		$io->on('workerStart', function()use($io) {
		    $inner_http_worker = new Worker('http://c.com:9191');
		    $inner_http_worker->onMessage = function($http_connection, $data)use($io){
		    	
		        if(!isset($_GET['msg'])) {
		            return $http_connection->send('fail, $_GET["msg"] not found');
		        }
		        $io->emit('senmsg from server', $_GET['msg']);
		        $http_connection->send($_GET['msg']);

		    };
		    $inner_http_worker->listen();
		    Timer::add(1, function()use($io){
	        global $uidConnectionMap, $last_online_count, $last_online_page_count;
	        $online_count_now = count($uidConnectionMap);
	        if($online_count_now>1){
	        $online_page_count_now = array_sum($uidConnectionMap);
	        }else{
	        $online_page_count_now=1;
	        }
	        // 只有在客户端在线数变化了才广播，减少不必要的客户端通讯
	        if($last_online_count != $online_count_now || $last_online_page_count != $online_page_count_now)
	        {
	            $io->emit('online_box', "当前<b>{$online_count_now}</b>人在线，共打开<b>{$online_page_count_now}</b>个页面");
	            $last_online_count = $online_count_now;
	            $last_online_page_count = $online_page_count_now;
	        }
		    });

		});
  
		
		Worker::runAll();
		}
}