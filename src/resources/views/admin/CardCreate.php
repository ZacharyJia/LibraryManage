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

    <form class="col-sm-12 form-horizontal" method="post" action="cardCreateAction">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="reader-name" class="col-sm-2 control-label">读者姓名</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="reader-name" name="reader-name" placeholder="读者姓名">
            </div>
        </div>
        <div class="form-group">
            <label for="sex" class="col-sm-2 control-label">性别</label>
            <div class="col-sm-7">
                <select id="sex" name="sex" class="form-control">
                    <option>男</option>
                    <option>女</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="birthday" class="col-sm-2 control-label">出生日期</label>
            <div class="col-sm-7">
                <input type="text" readonly class="form-control form_datetime" id="birthday" name="birthday" placeholder="例：1994-08-10">
            </div>
        </div>
        <script type="text/javascript">
            $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd', minView: 'month', autoclose: true});
        </script>
        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">电话号码</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="电话号码">
            </div>
        </div>
        <div class="form-group">
            <label for="mobile" class="col-sm-2 control-label">手机号码</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="手机号码">
            </div>
        </div>
        <div class="form-group">
            <label for="card-name" class="col-sm-2 control-label">证件类型</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="card-name" name="card-name" placeholder="证件类型" value="学生证">
            </div>
        </div>
        <div class="form-group">
            <label for="card-id" class="col-sm-2 control-label">证件号码</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="card-id" name="card-id" placeholder="证件号码">
            </div>
        </div>
        <div class="form-group">
            <label for="level" class="col-sm-2 control-label">读者等级</label>
            <div class="col-sm-7">
                <select id="level" name="level">
                    <?php
                    foreach($levels as $level)
                    {
                        echo '<option>'.$level['level'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">登陆用户名</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="password" name="password" placeholder="密码">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">信息无误，办理</button>
            </div>
        </div>
    </form>


</div>
<?php include('footer.php');?>
</body>
</html>