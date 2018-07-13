layui.define(['element', 'layer', 'form'], function(e) {
	var a = layui.layer,
		
		form = layui.form,
		

		element = layui.element,
		w = $(window).width();
	//console.log(i.base);
	var obj = {
		hello: function(str) {
			a.msg('Hello ' + (str || 'mymod'));
		},
		urltip: function(obj) {
			$('#lay-body').load(obj, '', function(res, status) {
				if(status == 'success') {
					a.closeAll();
				} else {
					$('#lay-body').html("<h2 class='t-c'>出错了！</h2>");
					a.closeAll();
				}
			});
		},
		reloadurl: function(url) {
			var _this = $('.lay-left').find('.layui-this>a').attr('data-url');
			if(_this != undefined) {
				this.urltip(_this);
			} else {
				this.urltip(url);
			}
		},
		screenw: function() {
			if(w < 640) {
				$('.lay-right').css('width', '100%');
				$('.lay-left').css('display', 'none');
			} else {
				$('.lay-header').css('width', (w - 200) + "px");
			}
		},
	};
	//监听导航点击
	element.on('nav(menulist)', function(elem) {
		var url = elem.attr('data-url'),
			title = elem.text(),
			f = elem.parents('li').find('a:first').text();
		if(url) {
			$('#stepnav').removeClass('layui-hide').html('<a href="{:URL(\'index/index\')}">主页</a><span lay-separator="">/</span><a>' + f + '</a><span lay-separator="">/</span><a><cite>' + title + '</cite></a>');
			obj.urltip(url);
			obj.screenw();
		}
	});

	$('#menuicon').click(function(elem) {
		var a = $(this),
			h = $(".lay-left").is(":hidden"),
			w = $(window).width();
		if(h != false) {
			$('.lay-left').show();
			$('.lay-right').css('width', (w - 200) + "px");
			$('.lay-header').css('width', (w - 200) + "px");
			a.find('i').removeClass('layui-icon-spread-left').addClass('layui-icon-shrink-right');
		} else {
			$('.lay-left').hide();
			$('.lay-right').css('width', '100%')
			$('.lay-header').css('width', w + "px");
			a.find('i').removeClass('layui-icon-shrink-right').addClass('layui-icon-spread-left');
		}
		//console.log($(".lay-left").is(":hidden"));	 	  	
	});
	$('#reload').click(function(res) {
		layer.load(3, {
			time: 10 * 1000
		});
		obj.reloadurl(layui.cache.centerurl);

	});
	
	$('#webinfo').click(function(){
		$('.layui-layer-adminRight').toggle(50);
	});
	//输出test接口
	e('index', obj);
});
