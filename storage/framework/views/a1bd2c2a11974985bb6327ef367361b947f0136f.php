<style>
  .resume {
    display: block;
    width: 45%;
    float: left;
    min-height: 300px;
  }

  .resume_list li {
    width: 50%;
    padding: 15px 10px;
    border: 1px solid green;
    font-size: 18px;
  }

  .demo-tree-more {
    display: block;
    border: 1px solid #999;
    width: 50%;
    float: left;
    min-height: 300px;
    font-size: 16px;
  }
</style>
<?php $__env->startSection('content'); ?>
<div class="layui-card">

  <div class="layui-card-body" style="min-height:600px;">
    <div class="layui-btn-group ">
      <a class="layui-btn layui-btn-sm" href="<?php echo e(route('admin.test.create')); ?>">添 加</a>
    </div>
    <div style="width:100%;margin-top:30px;">
      <div class="resume">
        <ul class="resume_list">
          <?php $__currentLoopData = $enters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li data-id="<?php echo e($vo->id); ?>"><?php echo e($vo->name); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <div id="qiaoen" class="demo-tree-more"></div>

    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
  var i = $(".resume_list li:first");
  var o = i.attr("data-id");
  $("li").click(function() {
    status = 1;
    var o = $(this).attr("data-id");
    layui.use(['tree', 'util'], function() {
      var tree = layui.tree,
        layer = layui.layer,
        util = layui.util
      $.post("<?php echo e(route('admin.tree')); ?>", {
        eid: o
      }, function(result) {
        tree.render({
          elem: '#qiaoen',
          data: result,
          showLine: true, //是否开启连接线
          onlyIconControl: true,
          edit: ['add', 'update', 'del'], //操作节点的图标
          operate: function(obj) {
            var type = obj.type; //得到操作类型：add、edit、del
            var data = obj.data; //得到当前节点的数据
            var elem = obj.elem; //得到当前节点元素
            if (type === 'add') { //增加节点
              $.post("<?php echo e(route('admin.atree.create')); ?>", {eid:data.eid,parent_id:data.id},function(result){

              });
            } else if (type === 'update') { //修改节点
              layer.open({
                  type: 2 //此处以iframe举例
                  ,title: data.name
                  ,area: ['500px', '750px']
                  ,shade: 0
                  ,maxmin: true
                  ,content: '/admin/atree/'+ data.id +'/edit'
                });
            } else if (type === 'del') { //删除节点
              $.post("<?php echo e(route('admin.atree.destroy')); ?>", {_method:'delete',id:data.id},function(result){

              });
            };
          }
        });
      }, 'json');

    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>