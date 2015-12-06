<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统</title>
    <?php include('reader/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-10">

    <div class="col-sm-12">
        <h1 class="text-center">密码修改</h1>
    </div>

    <div class="col-sm-offset-2 col-sm-6">
        <?php
        if (isset($msg))
        {
            echo '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
        }
        ?>
    </div>

    <form class="col-sm-12 form-horizontal" method="post" action="changePasswordAction">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="old-password" class="col-sm-2 control-label">原密码</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="old-password" name="old-password" placeholder="原始密码">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">新密码</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="password" name="password" placeholder="新密码">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">修改密码</button>
            </div>
        </div>
    </form>

</div>
</body>
</html>