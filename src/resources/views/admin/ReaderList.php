<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统——读者搜索</title>
    <?php include('admin/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-10">

    <table class="table table-hover">
        <thead>
        <th>读者证ID</th><th>姓名</th><th>性别</th><th>证件名称</th><th>证件编号</th><th>级别</th>
        </thead>
        <?php
        foreach($readers as $reader)
        {
            echo '<tr>';
            echo '<td>' . $reader['reader-id'] . '</td>';
            echo '<td><a href="readerDetail?id=' . $reader['reader-id'] . '">' . $reader["reader-name"] . '</td>';
            echo '<td>' . $reader['sex'] . '</td>';
            echo '<td>' . $reader["card-name"] . '</td>';
            echo '<td>' . $reader["card-id"] . '</td>';
            echo '<td>' . $reader["level"] . '</td>';
            echo '<tr>';
        }
        ?>
    </table>

    <?php
    echo $readers->render();
    ?>
</div>
</body>
</html>