<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>图书管理系统——图书入库</title>
    <?php include('admin/import.php'); ?>
</head>
<body>
<?php include('nav.php'); ?>
<div class="col-sm-10">

    <div class="col-sm-12">
        <h1 class="text-center">图书入库</h1>
    </div>

    <div class="col-sm-offset-2 col-sm-6">
        <?php
        if (isset($msg))
        {
            echo '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
        }
        ?>
    </div>

    <form class="col-sm-12 form-horizontal" method="post" action="bookInAction">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">图书名称</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="name" name="name" placeholder="图书名称">
            </div>
        </div>
        <div class="form-group">
            <label for="isbn" class="col-sm-2 control-label">ISBN</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN">
            </div>
        </div>

        <div class="form-group">
            <label for="author" class="col-sm-2 control-label">作者</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="author" name="author" placeholder="作者">
            </div>
        </div>
        <div class="form-group">
            <label for="publishing" class="col-sm-2 control-label">出版社</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="publishing" name="publishing" placeholder="出版社">
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">价格</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="price" name="price" placeholder="价格">
            </div>
        </div>
        <div class="form-group">
            <label for="quantity-in" class="col-sm-2 control-label">总数量</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="quantity-in" name="quantity-in" placeholder="总数量">
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">图书类别</label>
            <div class="col-sm-7">
                <select class="form-control" id="category" name="category">
                    <?php

                    foreach($categories as $category)
                    {
                        echo '<option value="' . $category->id . '">' . $category->category . '</option>';
                    }

                    ?>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">入库</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>