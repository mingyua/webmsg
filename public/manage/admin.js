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