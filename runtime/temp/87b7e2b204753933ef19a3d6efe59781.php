<?php /*a:1:{s:50:"D:\webmsg\application\manage\view\article\add.html";i:1532310468;}*/ ?>
<div class="layui-fluid">
	<div id="layui-row">
		<div class="layui-col-xs12">
			<div class="layui-card">
				<div class="layui-card-body">

					<div class="layui-form">
						<div class="layui-form-item">
							<label class="layui-form-label">栏目选择</label>
							<div class="layui-input-block">
								<select name="cateid">
									<option value="">请选择</option>
								</select>
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">标题</label>
							<div class="layui-input-block">
								<input name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" type="text">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">关键字</label>
							<div class="layui-input-block">
								<input name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" type="text">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">描述</label>
							<div class="layui-input-block">
								<textarea placeholder="请输入内容" class="layui-textarea"></textarea>
							</div>
						</div>
						<div class="layui-form-item">
							
							<div class="layui-input-block">
									<div class="layui-upload">										
										<blockquote class="layui-elem-quote layui-quote-nm layui-clear" style="margin-top: 10px;">												
											<img src="/public/manage/images/upload.png" id="test2" class="pull-left"/>
											<div class="pull-left" id="demo2"></div>
										</blockquote>
									</div>

							</div>
						</div>						
						<div class="layui-form-item layui-form-text">
							<label class="layui-form-label">内容</label>
							<div class="layui-input-block">
								<textarea placeholder="请输入内容" class="layui-textarea"></textarea>
							</div>
						</div>
						
						<div class="layui-form-item">
							<label class="layui-form-label">排序</label>
							<div class="layui-input-block">
								<input name="sort" lay-verify="title" autocomplete="off" placeholder="排序" class="layui-input" type="text">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">时间</label>
							<div class="layui-input-block">
								<input name="date" id="date" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input" type="text">
							</div>
						</div>
 
						<div class="layui-form-item">
							<label class="layui-form-label">状态</label>
							<div class="layui-input-block">
								<input name="status" value="1" title="显示" checked="" type="radio">
								<input name="status" value="0" title="不显示" type="radio">
							</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-input-block">
								<button class="layui-btn" lay-submit="" lay-filter="submit">立即提交</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="layui-clear" style="height: 100px;">&nbsp;</div>
</div>

<script src="/public/manage/admin.js" type="text/javascript" charset="utf-8"></script>

<script>
	layui.use(['table', 'form','upload','laydate'], function() {
		var table = layui.table,
		upload=layui.upload ,laydate = layui.laydate,
			form = layui.form;
		form.render();
  laydate.render({
    elem: '#date',
    type:'datetime',
    value: new Date(),
    isInitValue:true
    
  });		
 //多图片上传
  upload.render({
    elem: '#test2'
    ,url: '/upload/'
    ,multiple: true
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo2').append('<span class="pull-left" style="width: 100px;height: 100px; overflow: hidden;margin-left: 5px;border: 1px dashed #ccc;"><img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img" height="100%"></span>') 
      });
    }
    ,done: function(res){
      //上传完毕
    }
  });		
		
		
	});
</script>