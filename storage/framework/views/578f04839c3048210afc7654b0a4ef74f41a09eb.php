<?php $__env->startSection('content'); ?>
<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        <h2>编辑</h2>
    </div>
    <div class="layui-card-body">
        <form class="layui-form">
            <?php echo e(csrf_field()); ?>

            <div class="layui-form-item" action="">
                <label for="" class="layui-form-label">上级分类</label>
                <div class="layui-input-block">
                    <select name="parent_id" lay-search lay-filter="parent_id">
                        <option value="0">一级分类</option>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $first): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($first['id']); ?>" <?php if(isset($trees->parent_id)&&$trees->parent_id==$first['id']): ?> selected <?php endif; ?>><?php echo e($first['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="" class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" name="name" value="<?php echo e($trees->name); ?>" lay-verify="required" placeholder="请输入姓名" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="" class="layui-form-label">职称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" value="<?php echo e($trees->title); ?>" lay-verify="required" placeholder="请输入职称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="" class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="text" name="sort" value="<?php echo e($trees->sort ?? 0); ?>" lay-verify="required|number" placeholder="请输入数字" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" value="男" title="男" checked="">
                    <input type="radio" name="sex" value="女" title="女">
                </div>
            </div>
            <div class="layui-form-item " style="display: none;">
                <label for="" class="layui-form-label">id</label>
                <div class="layui-input-inline">
                    <input type="text" name="id" value="<?php echo e($trees->id); ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    layui.use(['form', 'laydate'], function() {
        var form = layui.form,
            layer = layui.layer;
        //监听提交
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

        form.on('submit(demo1)', function(data) {
            $.post("<?php echo e(route('admin.atree.update')); ?>", data.field, function(result) {
                parent.layer.close(index); //再执行关闭
                parent.location.reload();
            })
        });




    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>