<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <!-- start -->
    
    
    
   
  
    <!-- end -->
    <head>
    <meta charset="UTF-8">
    <title>管理中心_全民乐帮</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- 地图 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <!-- bootstrap 3.0.2 -->
    <link href="/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="/Public/Admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/Public/Admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/Admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    
     <script type="text/javascript" src="/Public/js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>    
    <script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>
    <script>
    $(function(){
        var ue = UE.getEditor('container',{
            serverUrl :'<?php echo U('模块/控制器/ueditor');?>'
        });
    })
    </script>
    <!-- 地图 -->
    <script type="text/javascript"
            src="http://webapi.amap.com/maps?v=1.3&key=f2d629822891e9824756511256d50914"></script>
    <script type="text/javascript"
            src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body class="skin-blue">
        
        <!-- header logo: style can be found in header.less -->
<header class="header" >
    <a href="" class="logo" style="background:#FF6600;font-family: 'Microsoft YaHei',! important;"  >
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        全民乐帮
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                <?php if($_SESSION['user']['username']!= null): ?><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="glyphicon glyphicon-user"></i>
                    <span><?php echo ($_SESSION['user']['username']); ?> <i class="caret"></i></span>
                    <?php else: ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>lebang <i class="caret"></i></span>
                    </a><?php endif; ?>
                    <ul class="dropdown-menu" style="min-width: 0px;">
                        <!-- User image -->
                       <!--  <li class="user-header bg-light-blue">
                           <img src="avatar3.png" class="img-circle" alt="User Image" />
                           <p>全民乐帮</p>
                           <p>
                               lebang - 生活服务
                               <small>注册于2016年8月19日</small>
                           </p>
                       </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer" style=" width:122px; float:right;">
                            <div class="pull-left">
                                <!-- <a href="#" class="btn btn-default btn-flat">用户信息</a> -->
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo U('Admin/login/logout');?>" class="btn btn-default btn-flat" >退出登陆</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            
            <?php
 $url = CONTROLLER_NAME.'/'.ACTION_NAME; ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- div class="user-panel">
            <div class="pull-left image">
                <img src="/Public/Admin/img/avatar3.png" class="img-circle" alt="User Image" />
            </div>
            <?php if($_SESSION['user']['username']!= null): ?><div class="pull-left info">
                <p>Hello, <?php echo ($_SESSION['user']['username']); ?></p>
        
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div><?php endif; ?>
        </div> -->
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="操作"/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu style='width:150px;'">
            <li class="active">
                <a href="<?php echo U('Admin/index');?>">
                    <i class="fa fa-msg"></i> <span>控制台</span>
                </a>
            </li>
             <li class="treeview <?php if($url == "User/list" OR $url == "User/list1" OR $url == "User/list2" OR $url == "User/list3" OR $url == "User/list4" OR $url == "User/fetch" OR $url == "User/add" OR $url == "User/bianji" OR $url == "User/edit" OR $url == "User/recharge" OR $url == "User/fetch2" OR $url == "User/fetch3" OR $url == "User/fetch1" OR $url == "User/fetch4"): ?>active<?php endif; ?>">
                <a href="<?php echo U('User/list2');?>">
                    <i class="fa fa-file"></i> <span>用户管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo U('User/list2');?>"><i class="fa fa-list"></i>待审核用户</a></li> 
                  <li><a href="<?php echo U('User/list4');?>"><i class="fa fa-list"></i>审核未通过</a></li>
                  <!--  <li><a href="<?php echo U('User/list');?>"><i class="fa fa-list"></i>所有用户</a></li> -->
                    <li><a href="<?php echo U('User/list1');?>"><i class="fa fa-list"></i>普通用户</a></li>
                    
                    <li><a href="<?php echo U('User/list3');?>"><i class="fa fa-list"></i>雷锋用户</a></li>
                    
                   <!--  <li><a href="<?php echo U('User/add');?>"><i class="fa fa-edit"></i>添加用户</a></li> -->
                </ul>
            </li>
            <!-- <li class="treeview">
                <a href="<?php echo U('Category/list');?>">
                    <i class="fa fa-th-large"></i> <span>分类</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Category/read');?>"><i class="fa fa-list"></i>分类</a></li>
                    <!-- <li><a href="<?php echo U('Category/add');?>"><i class="fa fa-edit"></i>分类添加</a></li> -->
                <!-- </ul>
            </li>  --> 
            <li class="treeview <?php if($url == "Order/list" OR $url == "Order/nopay" OR $url == "Order/liushi" OR $url == "Order/edit" OR $url == "Order/cancel" OR $url == "Order/fetch" OR $url == "Order/finish" OR $url == "Order/finishk" OR $url == "Order/nopayk" OR $url == "Order/liushik"OR $url == "Order/cancelk" OR $url == "Order/fetch" OR $url == "Order/fetch1" OR $url == "Order/fetch2" OR $url == "Order/fetch3" OR $url == "Order/fetch4"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Order/list');?>">
                    <i class="fa fa-file"></i> <span>任务管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Order/list');?>"><i class="fa fa-list"></i>进行中任务</a></li>
                    <li><a href="<?php echo U('Order/nopay');?>"><i class="fa fa-list"></i>未支付任务</a></li>
                    <li><a href="<?php echo U('Order/liushi');?>"><i class="fa fa-list"></i>流单的任务</a></li>
                    <li><a href="<?php echo U('Order/cancel');?>"><i class="fa fa-list"></i>取消的任务</a></li>
                    <li><a href="<?php echo U('Order/finish');?>"><i class="fa fa-list"></i>完成的任务</a></li>
                </ul>
            </li>
            
            <li class="treeview <?php if($url == "Shequ/list" OR $url == "Shequ/add" OR $url == "Shequ/bianji" OR $url == "Shequ/started" OR $url == "Shequ/starting" OR $url == "Shequ/qyadd" OR $url == "Shequ/qylist" OR $url == "Shequ/qybianji" OR $url == "Shequ/fetch1" OR $url == "Shequ/fetch2" OR $url == "Shequ/fetch3"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Shequ/started');?>">
                    <i class="fa fa-file"></i> <span>社区管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!-- <li><a href="<?php echo U('Shequ/list');?>"><i class="fa fa-list"></i>社区列表</a></li> -->
                    <li><a href="<?php echo U('Shequ/started');?>"><i class="fa fa-list"></i>启用的小区</a></li>
                    <li><a href="<?php echo U('Shequ/starting');?>"><i class="fa fa-list"></i>待开通小区</a></li>
                    <li><a href="<?php echo U('Shequ/qylist');?>"><i class="fa fa-list"></i>区域管理</a></li>
                    <!-- <li><a href="<?php echo U('Shequ/add');?>"><i class="fa fa-edit"></i>添加社区</a></li> -->
                </ul>
            </li>
             <li class="treeview <?php if($url == "Xinxianshi/list" OR $url == "Xinxianshi/list2" OR $url == "Xinxianshi/list3"OR $url == "Xinxianshi/list4" OR $url == "Xinxianshi/list5" OR $url == "Xinxianshi/list6" OR $url == "Xinxianshi/fetch" OR $url == "Xinxianshi/pingluncheck" OR $url == "Xinxianshi/fetch1" OR $url == "Xinxianshi/fetch2" OR $url == "Xinxianshi/fetch3"OR $url == "Xinxianshi/fetch4" OR $url == "Xinxianshi/zhiding" OR $url == "Xinxianshi/zhidingk" OR $url == "Xinxianshi/pingbik" OR $url == "Xinxianshi/dianzanlist" OR $url == "Xinxianshi/pinglunlist" OR $url == "Xinxianshi/bianji1"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Xinxianshi/list');?>">
                    <i class="fa fa-file"></i> <span>新鲜事管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>在线的新鲜事</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list6');?>"><i class="fa fa-list"></i>新鲜事评论</a></li>
                     <li><a href="<?php echo U('Xinxianshi/zhiding');?>"><i class="fa fa-list"></i>置顶新鲜事</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list4');?>"><i class="fa fa-list"></i>屏蔽新鲜事</a></li>
                     
                     <li><a href="<?php echo U('Xinxianshi/list5');?>"><i class="fa fa-list"></i>屏蔽的评论</a></li>

                   <!--  <li><a href="<?php echo U('Xinxianshi/listx');?>"><i class="fa fa-list"></i>置顶的新鲜事</a></li> -->
                </ul>
            </li>

           <!--  <li class="treeview <?php if($url == "Xinxianshi/list" OR $url == "Xinxianshi/list2" OR $url == "Xinxianshi/list3"OR $url == "Xinxianshi/list4" OR $url == "Xinxianshi/add" OR $url == "Xinxianshi/fetch" OR $url == "Xinxianshi/pingluncheck"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Xinxianshi/list');?>">
                    <i class="fa fa-file"></i> <span>新鲜事管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Xinxianshi/list');?>"><i class="fa fa-list"></i>所有新鲜事</a></li>
                  
                    <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>在线的新鲜事</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list4');?>"><i class="fa fa-list"></i>屏蔽的新鲜事</a></li>
                  
                </ul>
            </li> -->

            <li class="treeview <?php if($url == "Msg/list" OR $url == "Msg/add" OR $url == "Msg/edit"): ?>active<?php endif; ?>">
                <a href="<?php echo U('msg/list');?>">
                    <i class="fa fa-file"></i> <span>运营消息管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('msg/list');?>"><i class="fa fa-list"></i>消息列表</a></li>
                    <!-- <li><a href="<?php echo U('msg/add');?>"><i class="fa fa-edit"></i>消息添加</a></li> -->
                </ul>
            </li>

            <li class="treeview <?php if($url == "Shanghu/add" OR $url == "Shanghu/daishenhe" OR $url == "Shanghu/jinyong"OR $url == "Shanghu/renzheng" OR $url == "Shanghu/rzxq" OR $url == "Shanghu/weitongguo" OR $url == "Shanghu/tuijian" OR $url == "Shanghu/edit" OR $url == "Shanghu/rbianji" OR $url == "Shanghu/rtuijian" OR $url == "Shanghu/fetch" OR $url == "Shanghu/fetch1" OR $url == "Shanghu/fetch2" OR $url == "Shanghu/fetch3" OR $url == "Shanghu/fetch4"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Shanghu/daishenhe');?>">
                    <i class="fa fa-file"></i> <span>商户管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Shanghu/daishenhe');?>"><i class="fa fa-list"></i>待审核商户</a></li>
                    <li><a href="<?php echo U('Shanghu/weitongguo');?>"><i class="fa fa-list"></i>审核未通过</a></li>
                    <li><a href="<?php echo U('Shanghu/renzheng');?>"><i class="fa fa-list"></i>认证商户</a></li>
                    <li><a href="<?php echo U('Shanghu/tuijian');?>"><i class="fa fa-list"></i>推荐商户</a></li>
                    <li><a href="<?php echo U('Shanghu/jinyong');?>"><i class="fa fa-list"></i>禁用商户</a></li>
                 
                </ul>
            </li>





            <li class="treeview <?php if($url == "Fuwu/zaixian" OR $url == "Fuwu/list" OR $url == "Fuwu/list1"OR $url == "Fuwu/list2" OR $url == "fu/add" OR $url == "fuwu/fetch" OR $url == "fuwu/pingluncheck" OR $url == "Fuwu/edit" OR $url == "Fuwu/shanghufuwu" OR $url == "Fuwu/jinyongsh" OR $url == "Fuwu/add1" OR $url == "Fuwu/chak" OR $url == "Fuwu/chak1" OR $url == "Fuwu/chaksh" OR $url == "Fuwu/add" OR $url == "Fuwu/fetchlist" OR $url == "Fuwu/fetchlist1" OR $url == "Fuwu/fetchlist2" OR $url == "Fuwu/jinyongfetch" OR $url == "Fuwu/shnaghufetch"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Fuwu/shanghufuwu');?>">
                    <i class="fa fa-file"></i> <span>服务项目</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Fuwu/shanghufuwu');?>"><i class="fa fa-list"></i>商户服务项目</a></li>
                    <li><a href="<?php echo U('Fuwu/jinyongsh');?>"><i class="fa fa-list"></i>禁用服务项目</a></li>
                    <li><a href="<?php echo U('Fuwu/list');?>"><i class="fa fa-list"></i>服务项目模版</a></li>
                    <li><a href="<?php echo U('Fuwu/list1');?>"><i class="fa fa-list"></i>服务项目草稿</a></li>
                    <li><a href="<?php echo U('Fuwu/list2');?>"><i class="fa fa-list"></i>服务项目类别</a></li>
                 
                </ul>
            </li>



             <!-- <li class="treeview <?php if($url == "Xinxianshi/list6" OR $url == "Xinxianshi/fetch1" OR $url == "Xinxianshi/list7" OR $url == "Xinxianshi/list5"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Xinxianshi/list');?>">
                    <i class="fa fa-file"></i> <span>评论管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu"> -->
                    <!-- <li><a href="<?php echo U('Xinxianshi/list');?>"><i class="fa fa-list"></i>所有新鲜事</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/list1');?>"><i class="fa fa-list"></i>待审核</a></li> -->
                    <!-- <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>启用的新鲜事</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/list6');?>"><i class="fa fa-list"></i>所有评论</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list7');?>"><i class="fa fa-list"></i>在线的评论</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list5');?>"><i class="fa fa-list"></i>已屏蔽的评论</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/add');?>"><i class="fa fa-edit"></i>用户添加</a></li> -->
             <!--    </ul>
            </li> -->
            <li class="treeview <?php if($url == "Xinxianshi/listx" OR $url == "Xinxianshi/listx"): ?>active<?php endif; ?>">
               <a href="<?php echo U('Xinxianshi/list');?>">
                    <i class="fa fa-file"></i> <span>举报管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <!-- <li><a href="<?php echo U('Xinxianshi/list');?>"><i class="fa fa-list"></i>所有新鲜事</a></li> -->
                    <!-- <li><a href="<?php echo U('Xinxianshi/list1');?>"><i class="fa fa-list"></i>待审核</a></li> -->
                    <!-- <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>启用的新鲜事</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/listx');?>"><i class="fa fa-list"></i>被举报的新鲜事</a></li> -->
                    <!-- <li><a href="<?php echo U('Xinxianshi/listx');?>"><i class="fa fa-list"></i>被举报的评论</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/add');?>"><i class="fa fa-edit"></i>用户添加</a></li> -->
                </ul>
            </li>

            <li class="treeview <?php if($url == "Tixian/list" OR $url == "Tixian/list1"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Tixian/list');?>">
                    <i class="fa fa-file"></i> <span>财务管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Tixian/list1');?>"><i class="fa fa-list"></i>提现申请</a></li>
                    <li><a href="<?php echo U('Tixian/list');?>"><i class="fa fa-list"></i>交易记录</a></li>
                   <!--  <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>体现记录</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list4');?>"><i class="fa fa-list"></i>屏蔽的新鲜事</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/add');?>"><i class="fa fa-edit"></i>用户添加</a></li> -->
                </ul>

                </li>

                <li class="treeview <?php if($url == "Banben/andlist" OR $url == "Banben/ioslist" OR $url == "Banben/hlist" OR $url == "Banben/andadd" OR $url == "Banben/andedit" OR $url == "Banben/iosadd" OR $url == "Banben/iosedit" OR $url == "Banben/hadd" OR $url == "Banben/hedit" OR $url == "Banben/fetch" OR $url == "Banben/fetch1" OR $url == "Banben/fetch2"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Quanxian/list');?>">
                    <i class="fa fa-file"></i> <span>版本管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Banben/andlist');?>"><i class="fa fa-list"></i>Android</a></li>
                    <li><a href="<?php echo U('Banben/ioslist');?>"><i class="fa fa-list"></i>ios</a></li>
                    <li><a href="<?php echo U('Banben/hlist');?>"><i class="fa fa-list"></i>H5</a></li>
                    
                </ul>
            </li>

                <li class="treeview <?php if($url == "Master/list"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Master/list');?>">
                    <i class="fa fa-file"></i> <span>网站设置</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Master/list');?>"><i class="fa fa-list"></i>参数设置</a></li>
                    <li><a href="<?php echo U('Area/list');?>"><i class="fa fa-list"></i>区域设置</a></li>
                   <!--  <li><a href="<?php echo U('Xinxianshi/list4');?>"><i class="fa fa-list"></i>屏蔽的新鲜事</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/add');?>"><i class="fa fa-edit"></i>用户添加</a></li> -->
                </ul>
            </li>
            <li class="treeview <?php if($url == "Quanxian/list" OR $url == "Quanxian/list1" OR $url == "Quanxian/list2" OR $url == "Quanxian/list3" OR $url == "Quanxian/add" OR $url == "Quanxian/edit" OR $url == "Quanxian/edit1" OR $url == "Quanxian/edit2" ): ?>active<?php endif; ?>">
                <a href="<?php echo U('Quanxian/list');?>">
                    <i class="fa fa-file"></i> <span>权限管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Quanxian/list');?>"><i class="fa fa-list"></i>后台用户</a></li>
                    <li><a href="<?php echo U('Quanxian/list3');?>"><i class="fa fa-list"></i>禁用用户</a></li>
                    <li><a href="<?php echo U('Quanxian/list1');?>"><i class="fa fa-list"></i>分组管理</a></li>
                    <li><a href="<?php echo U('Quanxian/list2');?>"><i class="fa fa-list"></i>权限管理</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!--  /.sidebar -->
</aside>

            

    <!-- <script src="/Public/Admin/time/script/jquery-1.9.1.js"></script> -->
    <script src="/Public/Admin/time/script/mobiscroll.2.13.2.js"></script>
    <link href="/Public/Admin/time/style/mobiscroll.2.13.2.css" rel="stylesheet" />
    <script src="/Public/Admin/time/time.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/simditor/styles/simditor.css" />
<!-- <script type="text/javascript" src="/Public/simditor/scripts/jquery.min.js"></script> -->
    <script type="text/javascript" src="/Public/simditor/scripts/module.js"></script>
    <script type="text/javascript" src="/Public/simditor/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/Public/simditor/scripts/uploader.js"></script>
    <script type="text/javascript" src="/Public/simditor/scripts/simditor.js"></script>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <font class="font">新增商户</font>
             <a href= "javascript:history.back(-1);" class="btn btn-default0 pull-right"  style="position:relative;bottom:8px;">返回商户列表</a>
        </h1>
      
    </section>

    <!-- Main content -->
    <!-- <section class="content"> -->
    
   <script type="text/javascript" language="javascript"> 

            function confirmAct() 
            { 
                var content = editor.getValue();
                content = content.replace(/\ +/g,"");
                content = content.replace(/[ ]/g,"");
                content = content.replace(/[\r\n]/g,"");
                content = content.replace(/&nbsp;/g,"");
                content = $(content).text();

                // if(content == ''){
                //   alert('请输入店铺简介');
                //   return false;
                // }

                 if(!$('#dizhi').val()){
                   alert('请输入店铺地址');
                   return false;
                 }

          
                if(confirm('确定要执行此操作吗?')) 
                { 
                    return true; 
                } 
                return false; 
            } 
     function submits()  
     {  
 
         var submitId=document.getElementById('submit');  
         submitId.disabled=true; 
         
         // document.fm.submit();  
         // setTimeout('var submitId=document.getElementById("submit");submitId.disabled=false;',3000); //代码核心在这里，3秒还原按钮代码
         // return false;
    }  
</script>


<style>
    select{
        padding-left:10px;
    }
    input{
              text-indent:10px;
    }
    option{
      text-indent:10px;
    }
    textarea{
      padding-left: 10px;
    }

     .radio{
  -webkit-appearance:checkbox;
}
</style>

    <section class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="div-box">
                <div class="div-center"><!--/*居中*/-->
                    <form action="<?php echo U('Shanghu/add');?>" method="post" enctype="multipart/form-data" onsubmit="return submits();">
                <div class='left' style='float:left'>
                    
                        <div class="box-body">

                             <div class="form-group">
                                <label for="inputCover">用户手机</label>
                                <input class="ip" type="text" name="phone" id="inputPhone" placeholder="请输入手机号码"  oninput="getUser(this)"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')" onpropertychange="getUser(this)" list="country"/>
                                <datalist id="country">
                                </datalist>
                            </div>



    <link href="/Public/Admin/add/zyzn_1.css" rel="stylesheet" />
    <script>
            var znhycode=<?php echo ($area); ?>;
    </script>
    <script src="/Public/Admin/add/hgz_zncode.js"></script>

<script>
var openid = '';
    function getUser(addr){
            var xhr = new XMLHttpRequest();
            var user_data = '';
            if(xhr != null){
                var data = 'addr='+addr.value;
                xhr.open('POST',"<?php echo U('Shanghu/getUser');?>",false);
                xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                xhr.onreadystatechange = function(){
                    if(this.readyState ==4){
                        var user = JSON.parse(this.responseText);
                        user_data = user;
                        if(user.length>0){
                            $('#country').empty();
                            for (var i = 0;i <= user.length - 1; i++) {
                                $('#country').append('<option value="'+user[i].phone+'">');
                            }
                        }
                    }
                }
                xhr.send(data);
            }

            if(user_data.length>0){
                for (var i = 0;i <= user_data.length - 1; i++) {
                    if(addr.value == user_data[i].phone){
                        $('#nickname').val(user_data[i].nickname);
                        if(user_data[i].profession!=''){
                          $("#profession option").removeAttr("selected");
                          $("#profession option[value='"+user_data[i].profession+"']").prop("selected", true);
                        }
                        if(user_data[i].sex!=''){
                          $("#sex option").removeAttr("selected");
                          $("#sex option[value='"+user_data[i].sex+"']").prop("selected", true);
                        }
                        if(user_data[i].shequid!=0){
                          appendhyznbar($('#suozaixiaoqutxt'),'duoxuan','suozaixiaoqu');
                          $('.data-result').empty();
                          $('.data-result').append("<span class=\"svae_box aui-titlespan\" data-code=\""+user_data[i].shequid+"\"  data-name=\""+user_data[i].mingcheng+"\" onclick=\"removespan(this)\">"+user_data[i].mingcheng+"<i>×<\/i><\/span>");
                          svae_znitem();
                        }
                        $('#name').val(user_data[i].name);
                        if(user_data[i].birthday!=''){
                          var d = new Date(parseInt(user_data[i].birthday)*1000);
                          var mon = (d.getMonth()+1);
                          var day = d.getDate();
                          var str = d.getFullYear()+'-'+(mon<10?"0"+mon:mon)+'-'+(day<10?"0"+day:day);
                          $('#birthday').attr('value',str);
                        }

                        $('#idnumber').val(user_data[i].idnumber);
                        openid = user_data[i].openid;
                        if(user_data[i].avatar != ''){
                          $('#imghead1').attr('src','/photo/avatar/'+user_data[i].avatar);
                        }
                        if(user_data[i].idpic != ''){
                          $('#imghead2').attr('src','/photo/idpic/'+user_data[i].idpic);
                        }
                    }
                }
            }
            // getdianpu(openid);
    }
</script>

                            <div class="form-group">
                                <label for="inputSubject">昵称</label>
                                <input class="ip" type="text" name="nickname" id="nickname" placeholder="请输入昵称" maxlength="" />
                           </div>

                            <div class="form-group">
                                <label for="inputSubject">职业</label>
                                      <select class="ip" name="profession" id="profession">

                                      <option value="">请选择职业</option>
                                      <?php if(is_array($master)): foreach($master as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["mname"]); ?></option><?php endforeach; endif; ?>
                                      </select>
                            </div>

<!--                              <div class="form-group">
                                <label for="inputSubject">所在小区</label>
                                <select class="ip" name="suozaixiaoqu" id="suozaixiaoqu">
                                      <option value="">请选择所在小区</option>
                                      <?php if(is_array($shequ)): foreach($shequ as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["mingcheng"]); ?></option><?php endforeach; endif; ?>
                                      </select>
                           </div> -->

                      <div class="form-group">
                                <label for="inputCover">所在小区</label>
                                <input type="text" class="nation ip" value="" placeholder="请选择服务小区" data-value="" id="suozaixiaoqutxt" onclick="appendhyznbar(this,'duoxuan','suozaixiaoqu')" name="suozaixiaoqutxt"/>
                                <input type="hidden" name="suozaixiaoqu" id="suozaixiaoqu">
                            </div>
                   
                        <div class="form-group" style="margin-top:30px;">
                                <label for="inputCover">真实姓名</label>
                                <input class="ip" type="text" name="name" id="name" placeholder="请输入真实姓名" maxlength="" />
                            </div>

                         <div class="form-group">
                                <label for="inputCover">性别</label>
                                <select name="sex" id="sex" class='ip'>
                                  <option value="0">请选择</option>
                                  <option value="1">男</option>
                                  <option value="2">女</option>
                                </select>
                            </div>

                          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">生日</label>
                                <input class="ip" type="date" name="birthday" id="birthday" placeholder="" maxlength="" style="text-indent:4px;" />
                            </div>

                          <div class="form-group" style="margin-top:10px;">
                                <label for="inputCover">身份证号</label>
                                <input class="ip" type="text" name="idnumber" id="idnumber" placeholder="请输入身份证号" maxlength="" />
                            </div>
  <script>
      var dianpus;
      function getdianpu(dinapu){
      $.get("<?php echo U('shanghu/ajaxdianpu');?>?openid="+openid+"&dianpu="+dinapu.value,function(data,status){
        dianpus = data;
      $('#mingchengs').empty();
      for (var i = 0; i <= data.length - 1; i++) {
        $('#mingchengs').append('<option value="'+data[i].mingcheng+'">');
      }
      setdianpu(dinapu.value);
      // //   $('#'+id).append('<option value="'+data[i].id+'">'+data[i].mingcheng+'</option>');
      });
    }

    function setdianpu(dinapu){
      for (var i = 0; i <= dianpus.length-1; i++) {
        // if(dianpus[i].openid == openid){
          $('#dianhua').val(dianpus[i].dianhua);
          $('#demo1').val(dianpus[i].kaishishijian);
          $('#demo2').val(dianpus[i].jieshushijian);
          $('#dizhi').val(dianpus[i].dizhi);
          $('#imghead3').attr('src','/photo/shanghu/'+dianpus[i].logo);
          $('#imghead4').attr('src','/photo/shanghu/'+dianpus[i].zhizhao);
          //editor.setValue(dianpus[i].jianjie);
          $('#jianjie').val(dianpus[i].jianjie);
          editor.setValue(dianpus[i].jieshao);

          appendhybar($('#xiangmutxt'),'duoxuan','xiangmu');
          var xiangmu = dianpus[i].xiangmu.replace(/(^,)|(,$)/g,'');
          var xiangmus = xiangmu.split(',');
          for (var j = 0; j <= xiangmus.length-1; j++) {
              $('input[data-id="'+xiangmus[j]+'"]').prop("checked",true);
              addhyitem($('input[data-id="'+xiangmus[j]+'"]'));
          }
          svae_hyitem();

          appendhyznbar($('#quyutxt'),'duoxuan','quyu');
          var quyu = dianpus[i].quyu.replace(/(^,)|(,$)/g,'');
          var quyus = quyu.split(',');
          var quyutxt = dianpus[i].quyutxt.replace(/(^,)|(,$)/g,'');
          var quyutxts = quyutxt.split(',');
          $('.data-result').empty();
          for (var j = 0; j <= quyus.length-1; j++) {
            if(quyus[j] != ''){
              $('.data-result').append("<span class=\"svae_box aui-titlespan\" data-code=\""+quyus[j]+"\"  data-name=\""+quyutxts[j]+"\" onclick=\"removespan(this)\">"+quyutxts[j]+"<i>×<\/i><\/span>");
            }
          }

          svae_znitem();

        // }
      }
    }

  </script>
    

                        <div class="form-group" style="margin-top:30px;">
                                <label for="inputCover">店铺名称</label>
                                <input class="ip" type="text" name="mingcheng" id="mingcheng" placeholder="请输入店铺名称" maxlength="" onpropertychange="getdianpu(this)" oninput="getdianpu(this)" list="mingchengs"/>
                                <datalist id="mingchengs">
                                </datalist>
                            </div>
                        <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">客服电话</label>
                                <input class="ip" type="text" name="dianhua" id="dianhua" placeholder="请输入客服电话" maxlength="" />
                            </div>

                        <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">开业时间</label>
                                <input class="ip" type="text" name="kaishishijian" id="demo1" placeholder="请选择服务开始时间" maxlength=""/>
                              
                            </div> 

                        <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">打烊时间</label>
                            
                                <input class="ip" type="text" name="jieshushijian" id="demo2" placeholder="请选择服务打烊时间" maxlength=""/>
                            </div> 

                        
                            <!--  <div class="form-group" style=" float:left;">
                                <label for="inputCover"style="float: left;" >服务模式</label>
                              <div class="ip" style="float:left;position:relative;left:-1px;top: 0px;">

                              <div style="float: left;margin-left:10px; ">
                                 <input type="checkbox" style="float: left; margin-top:8px; " class="radio" name="daojia" value="1" ><font style="font-color:#dddddd;"> 到家服务</font>
                                 </div>

                                 <div style="float: left; margin-left:30px;">
                                   <input type="checkbox" style="float: left;margin-top:8px;" class="radio" name="daodian" value="1" > 到店服务
                                   </div>

                              </div>
        
                            </div>  -->
                        </div>
                   </div>

  
<!-- 调用的js--> 
 <script type="text/javascript" src="/PUBLIC/Admin/js/tinybox.js"></script>

    <div class='right' style="width:450px;float:left">
    <div id="content">
           

            <div id="preview1" style="margin-top:1px; margin-left:15px; ">
                <a href="javascript:void(0)" id="click_pic1" onclick="click_pic(1)">
                <img id="imghead1" style="width:140px; height:140px;"   border=0 src='/img/tx.jpg'>
                </a>
            </div>
                  <font style="margin-left:15px;">上传头像</font>
                <input type="file" class="tou-input" onchange="previewImage(this,1)"  name="avatar"  class="input" style="width:200px;margin-left:15px;"/>
            <br>
            <br>
            
             <div id="preview2" style="margin-top:15px; margin-left:15px;">
                <a href="javascript:void(0)" id="click_pic2" onclick="click_pic(2)">
                <img id="imghead2" style="width:140px; height:140px;" border=0 src='/img/sfz.jpg'>
                </a>
            </div>
                <font style="margin-left:15px;">上传证件</font>
                <input type="file" class="tou-input" onchange="previewImage(this,2)"  name="idpic"  class="input" style="width:200px;margin-left:15px; "/>
            <br>
            <br>
                    
            <div style="margin-top:20px;">
            <div  style="float: left;width:200px;margin-left:15px;">
            <div id="preview3">
                <a href="javascript:void(0)" id="click_pic3" onclick="click_pic(3)">
                <img id="imghead3" style="width:140px; height:140px;" border=0 src='/img/dinapu.jpg'>
                </a><br>
                
            </div>
                <font>上传店铺封面</font>
                <input type="file" class="tou-input" onchange="previewImage(this,3)"  name="logo"  class="input" style="width:200px;"/>
            </div>
            
            <div style="float: left;width:200px;padding-left:5px">
              <div id="preview4">
                <a href="javascript:void(0)" id="click_pic4" onclick="click_pic(4)">
                <img id="imghead4" style="width:140px; height:140px;" border=0 src='/img/yezz.jpg'>
                </a><br>
                
              </div>
                <font>上传营业执照</font>
                <input type="file" class="tou-input" onchange="previewImage(this,4)" name="zhizhao"  class="input" style="width:200px"/>
            </div>
            </div>
            
          </div>
       </div>
      <div style="clear: both;"></div>

    <link href="/Public/Admin/add/zyzn_1.css" rel="stylesheet" />
    <script>
            var znhycode=<?php echo ($fuwu); ?>;
    </script>
    <script src="/Public/Admin/add/hgz_hycode.js"></script>
          <div class="form-group">
                                <label for="inputCover">服务项目</label>
                                <input type="text" id="xiangmutxt" name="xiangmutxt" class="nation ip" value="" data-value="" data-id="" placeholder="请选择服务项目"   onclick="appendhybar(this,'duoxuan','xiangmu')" style="width:655px;"/>
                                <input type="hidden" id="xiangmu" name="xiangmu">
                            </div>

<div>

<script>
  function setXiangmu(id,txt){
    $('#xiangmutxt').val(txt);
  }

  function getArea(id,value){
    $.get("<?php echo U('shanghu/ajax');?>?id="+value,function(data,status){
      $('#'+id).empty();

      // var count=$("#"+id).get(0).options.length;
      for (var i = 0; i <= data.length - 1; i++) {
        // for(var ii=0;ii<count;ii++){
        //   if($("#"+id).get(0).options[ii].val == data[i].id)  
        //     {        
        //       break;  
        //     }
            
        // }
        $('#'+id).append('<option value="'+data[i].id+'">'+data[i].mingcheng+'</option>');
      }

      if(data.length>0){
        var quyu = data[0];
        // getShequ('shequ',$('#xingzhenqu').get(0).value,$('#xingzhenqu').get(0).text);
        getShequ('shequ',quyu.id,quyu.mingcheng);
      }
        // alert();
    });
  }

  function abcs(pid,phyid,phyname,id,lithis){
    $.get("<?php echo U('shanghu/ajaxshequ');?>?id="+id,function(data,status){
      abcss(pid,phyid,phyname,id,lithis,data);
    });
  }
  function getShequ(id,value,text){
    $.get("<?php echo U('shanghu/ajaxshequ');?>?id="+value,function(data,status){
      $('#'+id).empty();
      $('#'+id).append('<option value="0">--请选择--</option>');
      for (var i = 0; i <= data.length - 1; i++) {
        $('#'+id).append('<option value="'+data[i].id+'" quyuid="'+value+'" quyuming="'+text+'" >'+data[i].mingcheng+'</option>');
      }
    });
  }
  var yixiaoquarr = [];
  function xiaoqux(id,ming){
    if(id != 0){
      var quyuid = $('#shequ').find("option:selected").attr("quyuid");
      var quyuming = $('#shequ').find("option:selected").attr("quyuming");
      var abc = false;

      for (var i = 0; i <= yixiaoquarr.length - 1; i++) {
        // console.log(yixiaoquarr[i][0],yixiaoquarr[i][1],yixiaoquarr[i][2],yixiaoquarr[i][3]);
        if(quyuid == yixiaoquarr[i][0] && yixiaoquarr[i][2] == id){
          abc = true;
        }
      }

      if(abc == false){
        // $('#yixiaoqu').append('<option value="'+quyuid+'">'+quyuming+'</option>');
        $('#yixiaoqu').append('<option>'+quyuming+'-'+ming+'</option>');
        yixiaoquarr.push([quyuid,quyuming,id,ming]);

        addsx();
      }
    }
  }

  function delyixiaoqu(){

    var index = $('#yixiaoqu').prop('selectedIndex');

    if( index != 0 ){
      yixiaoquarr.splice(index-1,1);
      addsx();
      addyixiaoqu();
    }

  }

  function addyixiaoqu(){
    $('#yixiaoqu').empty();
    $('#yixiaoqu').append('<option value="">--已选择--</option>');
    for (var i = 0; i <= yixiaoquarr.length - 1; i++) {
      $('#yixiaoqu').append('<option>'+yixiaoquarr[i][1]+'-'+yixiaoquarr[i][3]+'</option>');
    }
  }

  function addsx(){
    var shequs = '';
    var xiaoqus = '';
    var shequtxt = '';
    var xiaoqutxt = '';
      for (var i = 0; i <= yixiaoquarr.length - 1; i++) {
        shequs = shequs + ',' + yixiaoquarr[i][0];
        xiaoqus = xiaoqus + ',' + yixiaoquarr[i][2];
        shequtxt = shequtxt + ',' + yixiaoquarr[i][1];
        xiaoqutxt = xiaoqutxt + ',' + yixiaoquarr[i][3];
      }

      $('#shequs').val(shequs+',');
      $('#xiaoqus').val(xiaoqus+',');
      $('#shequtxt').val(shequtxt.substr(1));
      $('#xiaoqutxt').val(xiaoqutxt.substr(1));
  }
</script>

    <script>
            var znhycode=<?php echo ($area); ?>;
    </script>
    <script src="/Public/Admin/add/hgz_zncode.js"></script>
          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">服务小区</label>
                                <input type="text" class="nation ip" value="" placeholder="请选择服务小区" data-value=""  onclick="appendhyznbar(this,'duoxuan','quyu')" style="width:655px;" name="quyutxt" id="quyutxt"/>
                                <input type="hidden" name="quyu" id="quyu">
                            </div>
<!-- 
                              <div class="form-group" style="float:left; ">
                                <label for="inputCover">服务行政区</label>
                                <select  id="" class='ip' style="width:288px;" onChange="getArea('xingzhenqu',this.value);"> 
                                  <option value="">请选择服务行政区</option>
                                  <?php if(is_array($area)): foreach($area as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['mingcheng']); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                          

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">服务区域</label>
                               <select id="xingzhenqu" class='ip' style="width:290px;" onChange="getShequ('shequ',this.value,this.options[this.selectedIndex].innerText);"> 
                                  <option value="">请选择服务区域</option>
                                </select>
                            </div>
     </div>

     <div>
                           <div style="clear: both;"></div>
                            <div class="form-group" style="float:left; ">
                                <label for="inputCover">服务小区</label>
                                <select id="shequ" class='ip' style="width:288px;" onchange="xiaoqux(this.value,this.options[this.selectedIndex].innerText)">  -->
                                  <!-- <option value="123" selected>请选择服务小区</option> -->
<!--                                 </select>
                            </div>

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">已选择小区</label>
                               <select id="yixiaoqu" class='ip' style="width:290px;" onchange="delyixiaoqu()"> 
                                  <option value="">--已选择--</option>
                                </select>
                            </div> -->

<!--                             <input type="hidden" name="quyu" id="shequs">
                            <input type="hidden" name="quyutxt" id="shequtxt">
                            <input type="hidden" name="xiaoqu" id="xiaoqus">
                            <input type="hidden" name="xiaoqutxt" id="xiaoqutxt"> -->
    </div>

                        
          <div class="form-group" style="margin-top:5px;clear: both;">
                                <label for="inputCover">店铺地址</label>
                                <input class="ip" type="text" name="dizhi" id="dizhi" placeholder="请输入店铺地址" maxlength="" style="width:655px;"/>
                            </div>
                   <div class="form-group">
                                <label for="inputSubject" >店铺简介</label>
                          
                                <input name="jianjie" class="ip" id="jianjie" placeholder="请输入一句店铺简介" style="width:655px;"></input>
                            </div>

                            <div class="form-group" style="width:735px;">
                              <label for="inputSubject"  style="height:40px;line-height:40px; width:735px;position: relative;top:7px; margin-top:-5px; ">店铺介绍</label>
                           <textarea id="neirong" name="jieshao" placeholder="请输入店铺介绍" ></textarea>
                            </div>

    <script>
  // $(document).ready(function() {
    var editor = new Simditor({
      textarea: $('#neirong'),
      //optional options
      defaultImage : '/Public/simditor/images/image.png', //编辑器插入图片时使用的默认图片
      upload : {
                url : '<?php echo U('Shanghu/addtupian');?>', //文件上传的接口地址
                params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
                fileKey: 'fileData', //服务器端获取文件数据的参数名
                connectionCount: 3,
                leaveConfirm: '正在上传文件'
            },  
    });
  // });
</script>

                            <div class="form-group">
                          
                            <button class="btn btn-primary0"  type="submit" id = "submit" name="submit" onclick="return confirmAct();" style="width:735px;margin-top:5px;" value="publish">添加</button>
                           
                        </div>
                       


<script type="text/javascript">

    function click_pic(id){
        var a1 = document.getElementById('click_pic'+id);
        var click_pic = "<img src='"+ a1.children[0].src +"' />";
        TINY.box.show(click_pic,0,0,0,1);
    }


</script> 
                        
                        



<!--弹出图片-->
<style type="text/css">
#tinybox{position:absolute; display:none; padding:10px;  z-index:2000;}
#tinymask{position:absolute; display:none; top:0; left:0; height:100%; width:100%; z-index:1500;background:#000000;}
#tinycontent{background:#ffffff; font-size:1.1em;}
</style>
<style type="text/css">
#preview{/* width:260px;height:190px; *//*border:1px solid #000;*/overflow:hidden;}
#imghead {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);}
</style>
<script type="text/javascript">
      //图片上传预览    IE是用了滤镜。
        function previewImage(file,id)
        {
          var MAXWIDTH  = 140; 
          var MAXHEIGHT = 140;
          var div = document.getElementById('preview'+id);
          if (file.files && file.files[0])
          {
              div.innerHTML ='<a href="javascript:void(0)" id="click_pic'+id+'" onclick="click_pic('+id+')"><img id=imghead'+id+' width=140 height=140></a>';
              var img = document.getElementById('imghead'+id);
              img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                // img.style.marginTop = rect.top+'px';
              }
              var reader = new FileReader();
              reader.onload = function(evt){img.src = evt.target.result;}
              reader.readAsDataURL(file.files[0]);
          }
          else //兼容IE
          {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead'+id+' width=140 height=140>';
            var img = document.getElementById('imghead'+id);
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
          }
        }
        function clacImgZoomParam( maxWidth, maxHeight, width, height ){
            var param = {top:0, left:0, width:width, height:height};
            if( width>maxWidth || height>maxHeight )
            {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;
                 
                if( rateWidth > rateHeight )
                {
                    param.width =  maxWidth;
                    param.height = Math.round(height / rateWidth);
                }else
                {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
</script>  


<script type="text/javascript">

    function click_pic(id){
        var a1 = document.getElementById('click_pic'+id);
        var click_pic = "<img src='"+ a1.children[0].src +"' />";
        TINY.box.show(click_pic,0,0,0,1);
    }

 
</script> 

<div class="clearfix"></div>

                </div><!-- /.box -->
                     
                   </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    </section><!-- /.content -->


<section class="content-footer">
        <div class="text-center">
        </div>
    </section><!-- /.content-footer -->
  

</aside><!-- /.right-side -->

            
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <!-- <script src="/Public/Admin/js/jquery.min.js"></script> -->
        <!-- Bootstrap -->
        <script src="/Public/Admin/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/Public/Admin/js/app.js" type="text/javascript"></script>


    </body>
</html>