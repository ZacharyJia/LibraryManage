<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统——管理主页</title>
    <?php include('admin/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-10">

    <div class="col-sm-offset-2 col-sm-6">
        <?php
        if (isset($msg))
        {
            echo '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
        }
        ?>
    </div>


    <form class="col-sm-12 form-horizontal" method="post" action="bookBorrowAction">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="isbn" class="col-sm-2 control-label">图书ISBN</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="图书ISBN">
            </div>
        </div>
        <div class="form-group">
            <label for="reader-id" class="col-sm-2 control-label">读者证编号</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="reader-id" name="reader-id" placeholder="读者证编号">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">借书</button>
            </div>
        </div>
    </form>

</div>
</body>
</html>