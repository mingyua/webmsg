<?php /*a:1:{s:50:"D:\webmsg\application\manage\view\index\index.html";i:1531986073;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>通用后台管理模板系统（单页面专业版）</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/public/manage/admin.css" media="all">
</head>
<body>
	<div class="lay-main">
		<div class="lay-left">
				<h2 class="laylogo">mingyu</h2>
				<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="menulist" style="margin-right: 10px;">
					<?php if(is_array($menulist) || $menulist instanceof \think\Collection || $menulist instanceof \think\Paginator): $i = 0; $__LIST__ = $menulist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				  <li class="layui-nav-item">
				    <a data-url="<?php echo htmlentities($v['url']); ?>"><i class="layui-icon <?php echo htmlentities($v['icon']); ?> mr-10"></i><?php echo htmlentities($v['name']); ?></a>
				    <?php if(!(empty($v['children']) || (($v['children'] instanceof \think\Collection || $v['children'] instanceof \think\Paginator ) && $v['children']->isEmpty()))): ?>
				    	<dl class="layui-nav-child">
				    	<?php if(is_array($v['children']) || $v['children'] instanceof \think\Collection || $v['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?>
				    	<dd><a data-url="<?php echo htmlentities($k['url']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($k['name']); ?></a></dd>
				    	<?php endforeach; endif; else: echo "" ;endif; ?>
				    	</dl>
				    <?php endif; ?>
				  </li>
				  <?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
		</div>
		<div class="lay-right">
				<div class="lay-header">
					<ul>
							<li id='menuicon' title="菜单"><i class="layui-icon layui-icon-shrink-right"></i></li>
							<a href="<?php echo URL('index/index/index'); ?>" target="_blank"><li class="layui-hide-xs" title="前台"><i class="layui-icon layui-icon-website"></i></li></a>
							<li id="reload" title="刷新"><i class="layui-icon layui-icon-refresh"></i></li>
					</ul>
					<ul class="pull-right">
							<li  title="通知"><i class="layui-icon layui-icon-notice"></i></li>
							<li class="layui-hide-xs"  title="主题"><i class="layui-icon layui-icon-theme"></i></li>
							<li class="layui-hide-xs"  title="便签"><i class="layui-icon layui-icon-note"></i></li>
							<li id="webinfo"  title="更多"><i class="layui-icon layui-icon-more-vertical"></i></li>
					</ul>
				</div>
				
				<div id="stepnav" class="lay-breadcrumb layui-hide"></div>
				<div id="lay-body"></div>		
				<div class="layui-layer-adminRight">
						<div class="layui-card">
							<div class="layui-card-header">13213213</div>
							<div class="layui-card-body">
								46465465
							</div>
						</div>
				</div>
		</div>
	</div>  	

  <script src="/public/layui/layui.js"></script>
  <script src="/public/js/jquery.min.js"></script>
  <script>
		layui.config({
		  base: '/public/manage/',
		  centerurl:"<?php echo URL('index/center'); ?>"
		}).extend({ 
		  index: 'index',
		  nicescroll: 'nicescroll',	
		});  	
  </script>
  
<script>layui.use(['index','nicescroll'], function() {
	var index = layui.index,centerurl = layui.cache.centerurl;
		index.reloadurl(centerurl);
		index.screenw();
	 $("#lay-body").niceScroll({
	    cursorcolor: "#5B76A1", //#CC0071 光标颜色
	    cursoropacitymax: 1, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
	    touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
	    cursorwidth: "5px", //像素光标的宽度
	    cursorborder: "0", // 	游标边框css定义
	    cursorborderradius: "5px", //以像素为光标边界半径
	    autohidemode: false //是否隐藏滚动条
    });	
    

		
});</script>
</body>
</html>


