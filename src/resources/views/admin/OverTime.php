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
    <table class="table table-hover">
        <thead>
        <th>图书名称</th><th>ISBN</th><th>读者证号</th><th>读者名称</th><th>借阅日期</th><th>应还日期</th>
        </thead>
        <?php
        foreach($borrows as $borrow)
        {
            $book = $borrow->book;
            $reader = $borrow->reader;
            echo '<tr>';
            echo '<td><a href="bookDetail?id=' . $borrow['book-id'] . '">' . $book["book-name"] . '</td>';
            echo '<td>' . $book['isbn'] . '</td>';
            echo '<td>' . $borrow['reader-id'] . '</td>';
            echo '<td><a href="readerDetail?id='. $borrow['reader-id'] . '">' . $reader['reader-name'] . '</td>';
            echo '<td>' . $borrow['date-borrow'] . '</td>';
            echo '<td>' . $borrow['date-should-return'] . '</td>';
            echo '<tr>';
        }
        ?>
    </table>


    <?php
    echo $borrows->render();
    ?>


</div>
<?php include('footer.php');?>
</body>
</html>