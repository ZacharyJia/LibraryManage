<!DOCTYPE html>
<html>
    <head>
    <?php include('import.php'); ?>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="login">
                    图书馆管理系统——登录
                </a>
                </div>

            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index">请登录</a></li>
                    </li>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <h1>登录</h1>
                <?php
                if (isset($errormsg)) {
                    echo '<div class="alert alert-danger" role="alert">'.$errormsg.'</div>';
                }
                ?>

            </div>

            <div class="panel panel-default col-sm-6 col-sm-offset-3">
                <div class="panel-body">
                    <form method="post" action="loginAction">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="username">用户名：</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名">
                        </div>
                        <div class="form-group">
                            <label for="password">密码：</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-block btn-primary" value="登录">
                            </div>
                            <div class="col-sm-6">
                                <input type="reset" class="btn btn-block btn-default" value="清空">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

    </body>
</html>
