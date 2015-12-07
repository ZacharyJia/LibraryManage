<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统——图书搜索</title>
    <?php include('admin/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-12" style="padding-bottom: 80px">

    <table class="table table-hover">
        <thead>
        <th>书名</th><th>ISBN</th><th>作者</th><th>出版社</th><th>类别</th><th>价格</th><th>馆藏总数</th><th>可借数</th>
        </thead>
        <?php
        foreach($books as $book)
        {
            echo '<tr>';
            echo '<td>' . $book["book-name"] . '</td>';
            echo '<td>' . $book['isbn'] . '</td>';
            echo '<td>' . $book["author"] . '</td>';
            echo '<td>' . $book["publishing"] . '</td>';
            echo '<td>'.$categories[$book["category-id"]].'</td>';
            echo '<td>￥'.$book['price'].'</td>';
            echo '<td>' . $book["quantity-in"] . '</td>';
            echo '<td>' . ($book["quantity-in"] - $book['quantity-out'] - $book['quantity-loss']). '</td>';
            echo '<tr>';
        }
        ?>
    </table>

    <?php
    echo $books->render();
    ?>
</div>

<?php
include('footer.php');
?>
</body>
</html>