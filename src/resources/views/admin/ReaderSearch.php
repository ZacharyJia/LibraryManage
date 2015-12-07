<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>读者查询</title>
    <?php include('admin/import.php'); ?>

</head>
<body>
<?php include('nav.php'); ?>

<div class="col-sm-10" style="padding-bottom: 80px">
    <div class="col-sm-12">
        <h1 class="text-center">读者查询</h1>
    </div>

    <form class="form-horizontal" action="readerSearchAction" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="reader-id" class="col-sm-2 control-label">读者编号</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="reader-id" name="reader-id" placeholder="读者编号">
            </div>
        </div>
        <div class="form-group">
            <label for="reader-name" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="reader-name" name="reader-name" placeholder="姓名">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">查询</button>
            </div>
        </div>

    </form>
</div>
<?php include('footer.php');?>
</body>
</html>