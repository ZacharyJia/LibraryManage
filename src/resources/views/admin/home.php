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
    <h2>常用功能</h2>
    <div class="col-sm-3">
        <a href="bookBorrow" class="btn btn-success btn-lg btn-block">图书借阅</a>
    </div>
    <div class="col-sm-3">
        <a href="bookReturn" class="btn btn-success btn-lg btn-block">图书归还</a>
    </div>
    <div class="col-sm-3">
        <a href="bookIn" class="btn btn-success btn-lg btn-block">图书入库</a>
    </div>
    <div class="col-sm-3">
        <a href="cardCreate" class="btn btn-success btn-lg btn-block">办理借书证</a>
    </div>


</div>
</body>
</html>