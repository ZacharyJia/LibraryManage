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


    <table class="table table-hover">
        <thead>
        <th>读者等级</th><th>借阅天数</th><th>借阅数量</th><th>读者费用</th><th>操作</th>
        </thead>
        <?php
        foreach($levels as $level)
        {
            echo '<tr>';
            echo '<td>' . $level['level'] . '</td>';
            echo '<td>' . $level['days'] . '</td>';
            echo '<td>' . $level['numbers'] . '</td>';
            echo '<td>￥' . $level['fee'] . '</td>';
            echo '<td><a href="levelDel?level='.$level['level'].'">删除</a></td>';
            echo '<tr>';
        }
        ?>
    </table>

    <a href="levelAdd" class="btn btn-primary">增加新等级</a>


</div>
<?php include('footer.php');?>
</body>
</html>