<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统——图书详情</title>
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

    <form class="col-sm-12 form-horizontal" method="post" action="bookEdit">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="id" value="<?php echo $book['book-id']; ?>">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">图书名称</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="name" name="name" placeholder="图书名称" value="<?php echo $book['book-name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="isbn" class="col-sm-2 control-label">ISBN</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" value="<?php echo $book['isbn']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="author" class="col-sm-2 control-label">作者</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="author" name="author" placeholder="作者" value="<?php echo $book['author']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="publishing" class="col-sm-2 control-label">出版社</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="publishing" name="publishing" placeholder="出版社" value="<?php echo $book['publishing']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">价格</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="price" name="price" placeholder="价格" value="<?php echo $book['price']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="date-in" class="col-sm-2 control-label">入库时间</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="date-in" name="date-in" placeholder="入库时间" value="<?php echo $book['date-in']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="quantity-in" class="col-sm-2 control-label">总数量</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="quantity-in" name="quantity-in" placeholder="总数量" value="<?php echo $book['quantity-in']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="quantity-out" class="col-sm-2 control-label">出借数量</label>
            <div class="col-sm-7">
                <input type="text" disabled="disabled" class="form-control" id="quantity-out" name="quantity-out" placeholder="出借数量" value="<?php echo $book['quantity-out']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="quantity-loss" class="col-sm-2 control-label">遗失数量</label>
            <div class="col-sm-7">
                <input type="text" disabled="disabled" class="form-control" id="quantity-loss" name="quantity-loss" placeholder="遗失数量" value="<?php echo $book['quantity-loss']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">图书类别</label>
            <div class="col-sm-7">
                <select class="form-control" id="category" name="category">
                    <?php

                    foreach($categories as $category)
                    {
                        if ($book['category-id'] == $category['id'])
                        {
                            echo '<option selected="selected" value="' . $category->id . '">' . $category->category . '</option>';
                        }
                        else
                        {
                            echo '<option value="' . $category->id . '">' . $category->category . '</option>';
                        }
                    }

                    ?>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">保存修改</button>
            </div>
        </div>

    </form>

</div>
</body>
</html>