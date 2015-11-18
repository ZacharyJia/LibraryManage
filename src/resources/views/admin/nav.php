<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="admin/home">
                图书馆管理系统——后台管理
            </a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a>您好，<?php echo $username; ?></a></li>
                <li><a href="../logoutAction">退出登录</a></li>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>


<div class="panel-group col-sm-2" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#BookManage" aria-expanded="true" aria-controls="collapseOne">
                    图书管理
                </a>
            </h4>
        </div>
        <div id="BookManage" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <ul>
                    <li><a href="bookSearch">图书查询</a></li>
                    <li><a href="bookIn">图书入库</a></li>
                    <li><a>图书借阅</a></li>
                    <li><a>图书归还</a></li>
                    <li><a>图书挂失</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#ReaderManage" aria-expanded="false" aria-controls="collapseTwo">
                    读者管理
                </a>
            </h4>
        </div>
        <div id="ReaderManage" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <ul>
                    <li><a>办理借书证</a></li>
                    <li><a>读者查询</a></li>
                    <li><a>借书证挂失</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#SystemManage" aria-expanded="false" aria-controls="collapseThree">
                    系统管理
                </a>
            </h4>
        </div>
        <div id="SystemManage" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                <li><a>读者等级管理</a></li>
                <li><a>逾期未还处理</a></li>
                <li><a>密码修改</a></li>
            </div>
        </div>
    </div>
</div>