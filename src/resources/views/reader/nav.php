<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home">
                图书馆管理系统
            </a>
        </div>

        <form class="navbar-form navbar-left" role="search" method="post" action="search">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" placeholder="搜索图书名称、作者、ISBN等">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
            <a href="advancedSearch" class="btn btn-default">高级搜索</a>
        </form>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="history">借阅历史</a></li>
                <li><a>您好，<?php echo $username; ?></a></li>
                <li><a href="../logoutAction">退出登录</a></li>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>