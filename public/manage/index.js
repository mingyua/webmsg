layui.define(['element', 'layer', 'form','upload','table'], function(e) {
	var a = layui.layer,
		$ = layui.jquery,
		form = layui.form,
		table = layui.table,
		upload = layui.upload,
		element = layui.element,		
		w = $(window).width(),
		mydata=3,
		diymsg='您无权访问此页面!',
		geturl="/manage/index/geturl";
	var fun = {
		access: function(str) {
			$.ajax({
				type:"get",
				url:geturl,
				data:{data:str},
				success:function(res){
					if(res.status==1){						
						$('#lay-body').load(str, '', function(res, status) {
							if(status == 'success') {
								$('#refurl').val(str);								
							} else {
								$('#lay-body').html("<h2 class='t-c'>出错了！</h2>");					
							}
							a.closeAll();
						});
					}else{
						a.alert(res.msg,{icon:res.icon,skin:'layui-layer-diy'});
					}
					
				}
			});
			
		},
		checkauth: function(url){
			
			$.ajax({
				async:false,
				type:"get",
				url:geturl,
				 dataType:"json",
				data:{data:url},
				success:function(res){
					if(res.status!=1){
						mydata=0;
						
					}else{
						mydata=1;
					}
				}
			});
			return mydata;
		},		
		screenw: function() {
			if(w < 640) {
				$('.lay-right').css('width', '100%');
				$('.lay-left').css('display', 'none');
			} else {
				$('.lay-header').css('width', (w - 200) + "px");
			}
		},
		popu: function(url,title,AW,AH){
			layer.open({
				title:title,
				type:2,
				closeBtn:1,
				offset: '50px',
				btn:'',
				shade: 0.1,
				area: [AW, AH],
				skin: 'layui-layer-diy',
			  content: url,
			})
		},
		ajaxsend: function(url,data,obj){
			$.ajax({
				type:"post",
				url:url,
				data:data,
				beforeSend: function () {
				  layer.load(3, {time: 10 * 1000});
				},
				success:function(res){
					if(res.status==1){
						layer.msg(res.msg,{icon:res.icon,time:2000},function(item){
							if((res.url).length>0){
								fun.access(res.url);
							}
							if(obj){
								obj.del();
							}							
						});
					}else{
						layer.msg(res.msg,{icon:res.icon});					
					}					
				},error:function(msg){
					layer.msg('网络错误，请重试！',{icon:5});						
				}
			});
		}
	};
	
		upload.render({
		    elem: '.demoMore'
		    ,before: function(){
		      layer.load(0);
		    }
		    ,done: function(res, index, upload){
		      var item = this.item;		      
		      item.html('<img src="../../'+res.data+'" height="100px">');
		      item.next('input').next('input').val(res.data);
		      layer.closeAll();
		      console.log(item.next('input').next('input')); //获取当前触发上传的元素，layui 2.1.0 新增
		    }
		 });
		 	

	//表格操作
		 table.on('tool(list)', function(obj){
		    var data = obj.data;
		    if(obj.event === 'detail'){
		      layer.msg('ID：'+ data.id + ' 的查看操作');
		    } else if(obj.event === 'del'){
		      var ajaxurl=$(this).attr('data-url'),msg=$(this).attr('data-msg');
		      if(fun.checkauth(ajaxurl)==0) {a.alert(diymsg,{icon:0,skin:'layui-layer-diy'});return false;}	     
		      layer.confirm(msg,{title:'删除提醒',skin: 'layui-layer-diy',closeBtn:1,offset: '200px'}, function(index){		      	
		      	fun.ajaxsend(ajaxurl,{id:data.id},obj);		        
		        layer.closeAll();
		      });
		    }else if(obj.event === 'ajax'){
		    	var ajaxurl=$(this).attr('data-url'),title=$(this).attr('data-title');
	 	        if(fun.checkauth(ajaxurl)==0) {a.alert(diymsg,{icon:0,skin:'layui-layer-diy'});return false;}
		    	fun.ajaxsend(ajaxurl,data,'');	
		    	layer.closeAll();
		    }else if(obj.event === 'copy'){

				layer.closeAll();
		    }
		    else if(obj.event === 'edit'){
		    	var ajaxurl=$(this).attr('data-url')+"?id="+data.id,title=$(this).attr('data-title');
		        if(fun.checkauth(ajaxurl)==0) {a.alert(diymsg,{icon:0,skin:'layui-layer-diy'});return false;}
		      	fun.popu(ajaxurl,title,'600px','700px');
		    }else if(obj.event === 'jumpurl'){		    	
				fun.access(data.jumpurl);
		    }
		  });	
		//状态修改
		  form.on('switch(status)', function(obj){
		  	var ajaxurl=$(this).attr('data-url'),id=$(this).attr('data-id'),st=1;
		    if(fun.checkauth(ajaxurl)==0) {a.alert(diymsg,{icon:0,skin:'layui-layer-diy'});return false;}
		  	if(obj.elem.checked == false){st=0;}
		  	$.post(ajaxurl,{id:id,status:obj.elem.checked});
		  });	
	//提交数据
	form.on('submit(submit)',function(data){
		var _this=$(this),url=$(this).attr('data-url'),val=_this.html();
		
		$.ajax({
			type:'post',
			url:url,
			data:data.field,
			beforeSend: function () {
			   _this.attr({ disabled: "disabled" }).text('正在提交数据...');
			},success:function(res){
				//layer.alert(JSON.stringify(data.field));exit;
				if(res.status==1){
					layer.msg(res.msg,{icon:res.icon,time:2000},function(item){
						if((res.url).length>0){							
							fun.access(res.url);
						}else{
							parent.$('#reload').click();
							parent.layer.closeAll();							
						}
					});
				}else{
					layer.msg(res.msg,{icon:res.icon});					
				}
				
			},complete: function () {
		       _this.removeAttr("disabled").html(val);
		    },error:function(){
				layer.msg('网络错误，请重试！',{icon:5});	
			}
		});
		//layer.msg(JSON.stringify(url));
	});
	
	//文章提交数据
	form.on('submit(article)',function(data){
		
		var ids = $("#demo2").children(".brick").map(function(){
                    return $(this).attr('sort')+"':'"+$(this).attr('dataimg');
                }).get().join(",");	                
       var newarr={imglist:ids,content:ue.getContent()},ajaxurl=$(this).attr('data-url'); 
       var postdata=$.extend(data.field, newarr);

       $.ajax({
       	type:"post",
       	url:ajaxurl,
       	data:postdata,
       	success:function(res){
       		console.log(res);
			if(res.status==1){
				layer.msg(res.msg,{icon:res.icon,time:2000},function(item){
					if((res.url).length>0){
						fun.access(res.url);
					}					
				});
			}else{
				layer.msg(res.msg,{icon:res.icon});					
			}					

       	},error:function(obj){
       		layer.msg('网络错误，请重试！',{icon:0});	
       	}
     });       		
	});	

	
	$('body').on("click", "*[lay-href]",function(){
		var e = $(this),
			i = e.attr("lay-href"),t = e.text();
			if(i.length>1){				
				fun.access(i);
			}
			
			//fun.jumpurl(i,t);	
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
		layer.load(3, {time: 3 * 1000});	
		var url=$('#refurl').val();
		if(url.length>0){
			fun.access(url);
		}else{
			a.closeAll();
		}
		
	});
	
	$('#webinfo').click(function(){
		$('.layui-layer-adminRight').toggle("fast");
	});
	
	//输出test接口
	e('index', fun);
});
