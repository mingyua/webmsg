<?php /*a:1:{s:49:"D:\webmsg\application\manage\view\menu\index.html";i:1531979400;}*/ ?>
<div class="layui-fluid">
	<div class="layui-row">
		<div class="layui-col-xs12">
			<div class="layui-card">
				<div id="demoTable" class="layui-card-header pt-10"> 
					<button  class="layui-btn layui-btn-danger" data-type="getCheckData" data-url="<?php echo URL('menu/alldel'); ?>"  title="删除选中"><i class="layui-icon layui-icon-delete"></i></button>
					<div class="layui-form pull-right">
						<div class="layui-form-item">							
							<div class="layui-inline"> <button class="layui-btn" data-type="add" data-title="添加菜单" dataw="500px" datah="600px" data-url="<?php echo URL('menu/add'); ?>" ><i class="layui-icon layui-icon-add-circle"></i>添加菜单</button> </div>
						</div>
					</div>
				</div>
				<div class="layui-card-body">
					<table class="layui-hide" id="tabledata" lay-filter="list"></table>
				</div>

		</div>
	</div>
</div>

<script type="text/html" id="switchTpl">
  <input type="checkbox" name="status" value="{{d.status}}" lay-skin="switch" lay-text="显示|不显示" data-id="{{d.id}}" data-url="<?php echo URL('menu/status'); ?>" lay-filter="status" {{ d.status == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="barDemo">
	<a class="layui-btn layui-btn-xs" data-url="<?php echo URL('menu/add'); ?>" data-title="编辑" lay-event="edit">编辑</a>
	<a class="layui-btn layui-btn-danger layui-btn-xs" data-msg="您确定要删除吗？" data-url="<?php echo URL('menu/delete'); ?>" lay-event="del">删除</a>
</script>
<script src="/public/manage/admin.js" type="text/javascript" charset="utf-8"></script>
<script>
	
layui.use(['table'], function() {
		var table=layui.table;
		table.render({
			elem: '#tabledata',
			url: "<?php echo URL('menu/menulist'); ?>" //数据接口
			,page: false //开启分页
			,id:'tablist'
			,cols: [
				[ //表头
					{
						checkbox: true,
						fixed: true,
						fixed: 'left'
					}, {
						field: 'id',
						title: 'ID',
						width: 80,
						sort: true
					}, {
						field: 'catename',
						title: '菜单名称'
						
					}, {
						field: 'url',
						title: '链接地址',
						sort: true
					},{field:'status', title:'状态', width:95, templet: '#switchTpl', unresize: true}
					, {
						fixed: 'right',
						width: 178,
						align: 'center',
						toolbar: '#barDemo'
					}
				]
			]
		});
	});
</script>