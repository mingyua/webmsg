<?php /*a:1:{s:48:"D:\webmsg\application\manage\view\set\index.html";i:1531989889;}*/ ?>
<div class="layui-fluid">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-header">网站设置</div>
        <div class="layui-card-body" pad15="">
          
          <div class="layui-form" wid100="" lay-filter="">
						<?php echo htmlentities(fieldhtml($list)); ?>
					  <div class="layui-form-item">
					    <div class="layui-input-block">
					      <a class="layui-btn" lay-submit="" lay-filter="submit" data-url="<?php echo URL('set/index'); ?>">确认提交</a>
					    </div>
					  </div>						
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <div class="layui-clear" style="height: 60px;">&nbsp;</div>
</div>


<script type="text/javascript">
	layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
		 upload.render({
		    elem: '.demoMore'
		    ,before: function(){
		      layer.load(0);
		    }
		    ,done: function(res, index, upload){
		      var item = this.item;		      
		      item.html('<img src="/'+res.data+'" height="100px">');
		      item.next('input').next('input').val(res.data);
		      layer.closeAll();
		      console.log(item.next('input').next('input')); //获取当前触发上传的元素，layui 2.1.0 新增
		    }
		 });
		
		
		
		
	});
</script>