<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统——管理主页</title>
    <?php include('admin/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-10" style="padding-bottom: 80px">
    <div class="col-sm-offset-2 col-sm-6">
        <?php
        if (isset($msg))
        {
            echo '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
        }
        ?>
    </div>


    <form class="col-sm-12 form-horizontal" method="post" action="levelAddAction">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="level" class="col-sm-2 control-label">用户等级（整数）</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="level" name="level" placeholder="用户等级">
            </div>
        </div>
        <div class="form-group">
            <label for="days" class="col-sm-2 control-label">可借阅天数</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="days" name="days" placeholder="可借阅天数">
            </div>
        </div>
        <div class="form-group">
            <label for="numbers" class="col-sm-2 control-label">可借阅数量</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="numbers" name="numbers" placeholder="可借阅数量">
            </div>
        </div>
        <div class="form-group">
            <label for="fee" class="col-sm-2 control-label">读者费用</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="fee" name="fee" placeholder="读者费用">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">添加</button>
            </div>
        </div>
    </form>

</div>
<?php include('footer.php');?>
</body>
</html>