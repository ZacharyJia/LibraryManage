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
    <table class="table table-hover">
        <thead>
        <th>图书名称</th><th>ISBN</th><th>借阅日期</th><th>应还日期</th><th>归还日期</th><th>是否归还</th><th>是否丢失</th>
        </thead>
        <?php
        foreach($borrows as $borrow)
        {
            $book = $borrow->book;
            $reader = $borrow->reader;
            echo '<tr>';
            echo '<td>' . $book["book-name"] . '</td>';
            echo '<td>' . $book['isbn'] . '</td>';
            echo '<td>' . $borrow['date-borrow'] . '</td>';
            echo '<td>' . $borrow['date-should-return'] . '</td>';
            echo '<td>' . ($borrow['date-return'] == '0000-00-00' ? "未归还": $borrow['date-return'] ). '</td>';
            echo '<td>' . ($borrow['returned'] == true? '是':'否'). '</td>';
            echo '<td>' . ($borrow['loss'] == true? '是':'否') . '</td>';
            echo '<tr>';
        }
        ?>
    </table>

    <?php
    echo $borrows->render();
    ?>


</div>
</body>
</html>