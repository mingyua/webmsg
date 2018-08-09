layui.define('index',function(e){ 
  var $=layui.$, table=layui.table,layer=layui.layer,form=layui.table,head=layui.index;
   var myobj = {
    reload: function(){
      var demoReload = $('#keywords'),cateid=$('#cateid'),daterange=$('#daterange'),st=$('#status');
      table.reload('tablist', {
        page: {
          curr: 1 //重新从第 1 页开始
        }
        ,where: {  
        	key:{
          	cid:cateid.val(),
            title: demoReload.val(),
            addtime:daterange.val(),
            status:st.val()
           }
        }
      });
    },  	
   	
   		getCheckData: function(){ //获取选中数据
	      var checkStatus = table.checkStatus('tablist')
	      ,data = checkStatus.data,ajaxurl=$(this).attr('data-url');
	      
	      
	      if(data.length<=0){
	      	 layer.alert('至少选择一条数据！',{btn:'',title:'提示',skin: 'layui-layer-diy',closeBtn:1,offset: '200px'});
	      }else{
	      	
	      	layer.confirm('您确认要删除所有？',{title:'删除提醒',skin: 'layui-layer-diy',closeBtn:1,offset: '200px'}, function(index){
		      	head.ajaxsend(ajaxurl,{data:data},'');		        
		        layer.closeAll();
		      });

	      	
	      }
	      
		},	
   		backupdata: function(){ //获取选中数据
	      var checkStatus = table.checkStatus('tablist')
	      ,data = checkStatus.data,ajaxurl=$(this).attr('data-url'),_this=$(this);
	      
	      
	      if(data.length<=0){
	      	 layer.alert('至少选择一条数据！',{btn:'',title:'提示',skin: 'layui-layer-diy',closeBtn:1,offset: '200px'});
	      }else{
	      	_this.html("正在发送备份请求...");
	      	
					$.post(ajaxurl,data,function(item) {
						if(data.code == 1) {
							_this.html("开始备份，请不要关闭本页面！");
							backup(data.data.tab);
							window.onbeforeunload = function() {
								return "正在备份数据库，请不要关闭！"
							}
						} else {
							layer.tips(data.msg, "#export", {
								tips: [1, '#3595CC'],
								time: 4000
							});
							_this.html("备份数据");
						}
						
							//layer.alert(JSON.stringify(item));
				
						});
					return false;	      	
	      	
		      	//head.ajaxsend(ajaxurl,{name:data},'');		        
		        layer.closeAll();
	      }
	      
		},	
		imports:function(){
			var url=$(this).attr('data-url');
				layer.open({
					title:'请选择还原文件',
					type:2,
					closeBtn:1,
					offset: '50px',
					btn:'',
					shade: 0.1,
					area: ['800px', '600px'],
					skin: 'layui-layer-diy',
				  content: url,
				})
			
		},
		add:function(){
			var url=$(this).attr('data-url'),AW=$(this).attr('dataw'),AH=$(this).attr('datah'),Atitle=$(this).attr('data-title');
				layer.open({
					title:Atitle,
					type:2,
					closeBtn:1,
					offset: '50px',
					btn:'',
					shade: 0.1,
					area: [AW, AH],
					skin: 'layui-layer-diy',
				  content: url,
				})
		}		
	}

	$('#demoTable .layui-btn').on('click',function(res){
		 var type = $(this).data('type');
    myobj[type] ? myobj[type].call(this) : '';
	});
  //输出test接口
  e('admin', myobj);
});    