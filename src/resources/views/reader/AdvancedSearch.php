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
    <form class="form-horizontal" action="advancedSearchAction" method="post">
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
            <label for="category" class="col-sm-2 control-label">图书类别</label>
            <div class="col-sm-7">
                <select class="form-control" id="category" name="category">
                    <?php
                    foreach($categories as $category)
                    {
                        echo '<option value="' . $category->id . '"">' . $category->category . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">搜索</button>
            </div>
        </div>

    </form>
</div>
</body>
</html>