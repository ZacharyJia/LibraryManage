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

    <table class="table table-hover">
        <thead>
        <th>书名</th><th>ISBN</th><th>作者</th><th>出版社</th><th>类别</th>
        </thead>
        <?php
        foreach($books as $book)
        {
            echo '<tr>';
            echo '<td><a href="bookDetail?id=' . $book['book-id'] . '">' . $book["book-name"] . '</td>';
            echo '<td>' . $book['isbn'] . '</td>';
            echo '<td>' . $book["author"] . '</td>';
            echo '<td>' . $book["publishing"] . '</td>';
            echo '<td>'.$categories[$book["category-id"]].'</td>';
            echo '<tr>';
        }
        ?>
    </table>

    <?php
    echo $books->render();
    ?>
</div>
</body>
</html>