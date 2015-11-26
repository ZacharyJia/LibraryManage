<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统</title>
    <?php include('reader/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-12">
    <?php
    $level = null;
    foreach ($levels as $l)
    {
        if($l->level == $reader['level'])
        {
            $level = $l;
        }
    }
    ?>

    <div class="well col-sm-3">
        您的读者号为：<?php echo $reader['reader-id']; ?> <br />
        您的读者等级为：<?php echo $reader['level']; ?> <br />
        您共可以借书：<?php echo $level['days']; ?> 本 <br />
        您每次可以借书：<?php echo $level['numbers']; ?>天<br />
    </div>

    <div class="col-sm-12">
        <h2>您有以下图书待归还：</h2>
        <table class="table table-hover">
            <?php
            if(count($borrows) != 0)
            {
                echo '<th>书名</th><th>ISBN</th><th>借阅日期</th><th>应还日期</th>';
            }
            foreach($borrows as $borrow)
            {
                $book = $borrow->book;
                echo '<tr>';
                echo '<td>'.$book['book-name'].'</td>';
                echo '<td>'.$book['isbn'].'</td>';
                echo '<td>'.$borrow['date-borrow'].'</td>';
                echo '<td>'.$borrow['date-should-return'].'</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>