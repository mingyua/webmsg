layui.use(['table','form','laydate','tableSelect'], function() {
		var table=layui.table,form=layui.form,tableSelect = layui.tableSelect;
		form.render();
		form.on('radio(radiotype)', function(data){
			var menuid=$('#menuid').val();
		 if(data.value=='click'){
		 	$('.menunavbox').show();	
		 	$('#urlbox ').hide();	
		 	$('#tuwenbox').removeClass('disnone');	
		 }else{
		 	$('.menunavbox').show();	
		 	$('#urlbox').show();	
		 	$('#tuwenbox').addClass('disnone');	
		 	
		 }
		 rightlist(menuid);
		console.log(data);
		}); 
	
	var obj=wxmenudata;
	var button=obj.menu.button;//一级菜单
	//一级菜单
	function showMenu(){		

		$.each(button,function(index,item){
			$('#menunav').append('<li id="menuClick" menuid="'+item.id+'"  sort="'+item.sort+'"  unid="'+item.unid+'"  pid="0" level="1" '+menuType(item)+'>'+item.name+'</li>');
			$('.wxmenulist').append('<ul id="childrenmenu'+item.id+'" sort="'+item.sort+'"><p data-num="'+item.id+'"><i class="layui-icon layui-icon-add-1"></i></p></ul>');
			if(item.sub_button.length>0){
				showList(item.sub_button,item.id);
			}
		});
		
				var nav=$('#menunav li').get();
				keysort(nav,'sort','#menunav');
				var list=$('.wxmenulist ul').get();	
				keysort(list,'sort','.wxmenulist');

		
	}
	
	//数组排序
	function keysort(arr,keys,box){		
		$(box).children('li').remove();
			 var newarr=arr.sort(function(a,b) {  
			      var elementone = $(a).attr(keys);  
			       var elementtwo = $(b).attr(keys); 
			       return elementone-elementtwo;
			      
			 });
			 //console.log(newarr);
			// var html='';
		 $.each(newarr, function(k,v) {
			$(box).append(v);			 	
		 });
		 //return html;

	}
	
	//二级菜单 
	function showList(arr,fid){
		$.each(arr,function(key,val){
			$('#childrenmenu'+fid).append('<li id="menuClick" menuid="'+val.id+'" sort="'+val.sort+'" unid="'+val.unid+'" pid="'+fid+'" level="2"  '+menuType(val)+'>'+val.name+'</li>');
		});	
				var list=$('#childrenmenu'+fid+" li").get();	
				//console.log(list);
				keysort(list,'sort','#childrenmenu'+fid);

 		
	}
	//菜单类型
	function menuType(data){
		var attrs='';
		if(data.type=='view'){
			attrs='type="view" url="'+data.url+'"';
		}else if(data.type=='click'){
			attrs='type="click" key="col_'+data.id+'"';
			
		}else{
			attrs='';
		}
		return attrs;
	}
	
	//菜单点击事件
	
	$('#wxmenu').on('click','li',function(e){
		var _this=$(this),
			data={
				id:_this.attr('id'),
				menuid:_this.attr('menuid'),
				pid:_this.attr('pid'),
				level:_this.attr('level'),
				type:_this.attr('type'),
				url:_this.attr('url'),
				sort:_this.attr('sort'),
				unid:_this.attr('unid'),
				name:_this.text()

			};			
			selectitem(data);
			rightlist(data.menuid);
		
	});
	//右边图文显示
	function rightlist(id){
		
			ajaxmenu(id,'rightlist');
	}
	
	//菜单选中事件
	function selectitem(data){
		$('#itemid').val(data.pid);
		$('#menuid').val(data.menuid);
		$('#menuname').val(data.name);
		$('#menuurl').val(data.url);
		$('#sort').val(data.sort);
		$('#unid').val(data.unid);
		
		///console.log(data);
		if(data.type=='click'){
			$('.menunavbox').show();		
			document.getElementById('menutype1').checked=true;
		 	$('#urlbox').hide();	
		 	$('#tuwenbox').removeClass('disnone');	
			
		}else if(data.type==undefined){
			$('.menunavbox').hide();		
		}else{
			$('.menunavbox').show();		
			document.getElementById('menutype2').checked=true;
		 	$('#urlbox').show();	
		 	$('#tuwenbox').addClass('disnone');	
			
		}	
		form.render();
	}	
	
	//添加菜单
	$('.wxmenulist').on('click','ul>p',function(){
		var pid=$(this).attr('data-num'),lilen=$('#childrenmenu'+pid).children('li').length;
		if(lilen<5){
			addMenu(pid,lilen);
		}else{
			layer.msg('子菜单最多5个.',{icon:5});
		}
		
	});
	//添加菜单事件
	function addMenu(menuid,len){
		if(len<1){
			layer.confirm('添加子菜单后，一级菜单的内容将被清除。确定添加子菜单？', {
			  btn: ['确定','取消'] //按钮
			}, function(){
				ajaxmenu(menuid,'addMenu');
			}, function(){});
		}else{
			ajaxmenu(menuid,'addMenu');
		}
		
	}
	
	//删除菜单
	$('.del').click(function(){
		var pid=$('#itemid').val(), menuid=$('#menuid').val(),lilen='',msg='';
		if(pid==0){
			lilen=$('#childrenmenu'+menuid).children('li').length;
		}else{
			lilen=$('#childrenmenu'+pid).children('li').length;
		}
		if(lilen>1){
			msg='1';
		}else if(lilen==1){
			msg='删除子菜单后,将重置主菜单';
		}else{
			msg='删除主菜单';
		}
		delMenu(menuid,lilen,msg);
		//console.log(lilen);

	});
	
	//删除菜单事件
	function delMenu(menuid,len,msg){
		if(len==1){
			layer.confirm(msg, {
			  btn: ['确定','取消'] //按钮
			}, function(){
				ajaxmenu(menuid,'delMenu');
				
			}, function(){});
			
			
		}else{
			
			ajaxmenu(menuid,'delMenu');
		}
		
	}

	function ajaxmenu(pid,act){
		$.ajax({
			type:"post",
			url:"http://"+window.location.host+'/manage/wxchat/'+act,
			data:{pid:pid},
			success:function(res){
				layer.closeAll();
				if(res.act=='add'){
					$('#childrenmenu'+pid).append('<li id="menuClick" menuid="'+res.id+'" sort="1" pid="'+pid+'" level="2" type="view" url="http://www.xxx.com/" >子菜单</li>');					
					$('#reload').click();
				}else if(res.act=='rightlist'){
					$('.article:first').siblings('.article').remove();
					$.each(res.data,function(i,v){
						$('#tuwenbox').append('<div class="article bd-bd"><p class="t-l pl-10">'+v.title+'</p> <p><img src="/'+v.thumb+'"/></p> <p class="t-l  pl-10">'+v.description+'</p> </div> ');							
					});
				}else{
					console.log(res);
					layer.msg(res.msg,{icon:res.status,time:1000},function(){
						$('#reload').click();
					});
				}

				
				
			}
		});		
	}
	//菜单生成
	$('#wxmenucreate').click(function(){
			layer.confirm('如非必须,请勿频繁生成菜单,您确认要执行此操作吗？', {
			  btn: ['确定','取消'] //按钮
			}, function(){
				ajaxmenu('wxmenu','createMenu');
			}, function(){});		
		
	});
	$('#wxmenudel').click(function(){
			layer.confirm('如非必须,请勿频繁删除菜单,您确认要执行此操作吗？', {
			  btn: ['确定','取消'] //按钮
			}, function(){
				ajaxmenu('wxmenu','menu_delete');
			}, function(){});		
		
	});



 form.verify({
    name: function(value){
      if(value.length > 5){
        return '菜单名称不超过5个汉字或16个字符';
      }
    }
  });


	showMenu();

	tableSelect.render({
		elem: '#tableSelect',	//定义输入框input对象 必填
		checkedKey: 'id', //表格的唯一建值，非常重要，影响到选中状态 必填
		searchKey: 'title',	//搜索输入框的name值 默认keyword
		searchPlaceholder: '关键词搜索',	//搜索输入框的提示文字 默认关键词搜索
		table: {	//定义表格参数，与LAYUI的TABLE模块一致，只是无需再定义表格elem
			url:"http://"+window.location.host+'/manage/wxchat/lists',
			page:{limit:5,limits:[5,10]},
			cols: [[
				{ type: 'checkbox' },
				{ field: 'id', title: 'ID', width: 100 },
				{ field: 'title', title: '标题' }
			]]
		},
		done: function (elem, data) {
			
			if(data.data.length>5){
				layer.msg('最多选择5条数据',{icon:5});
			}else{
				var unid=[];
				$('.article:first').siblings('.article').remove();
				$.each(data.data, function(k,v) {
					unid.push(v.id);
					
					$('#tuwenbox').append('<div class="article bd-bd"><p class="t-l pl-10">'+v.title+'</p> <p><img src="/'+v.thumb+'"/></p> <p class="t-l  pl-10">'+v.description+'</p> </div> ');					
				});								
				$('#unid').val(unid);
			}
			
		}
	});
});