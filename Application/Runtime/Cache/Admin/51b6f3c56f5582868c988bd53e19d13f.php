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
            
            <li class="treeview <?php if($url == "Shequ/list" OR $url == "Shequ/add" OR $url == "Shequ/bianji" OR $url == "Shequ/started" OR $url == "Shequ/starting" OR $url == "Shequ/qyadd" OR $url == "Shequ/qylist" OR $url == "Shequ/fetch1" OR $url == "Shequ/fetch2" OR $url == "Shequ/fetch3"): ?>active<?php endif; ?>">
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
                    <i class="fa fa-file"></i><span>商户服务项目</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Fuwu/shanghufuwu');?>"><i class="fa fa-list"></i>商户服务</a></li>
                    <li><a href="<?php echo U('Fuwu/jinyongsh');?>"><i class="fa fa-list"></i>禁用商户服务</a></li>
                    <li><a href="<?php echo U('Fuwu/list');?>"><i class="fa fa-list"></i>服务项目管理</a></li>
                    <li><a href="<?php echo U('Fuwu/list1');?>"><i class="fa fa-list"></i>待开通服务</a></li>
                    <li><a href="<?php echo U('Fuwu/list2');?>"><i class="fa fa-list"></i>服务类别管理</a></li>
                 
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

            
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <font class="font">新增社区</font>
             <a href="<?php echo U('Shequ/started');?>" class="btn btn-default0 pull-right"  style="position:relative;bottom:8px;">返回启用小区</a>
        </h1>

    </section>

    <!-- Main content -->
    <!-- <section class="content"> -->
    
   <script type="text/javascript" language="javascript"> 

            function confirmAct() 
            { 
                if(confirm('确定要执行此操作吗?')) 
                { 
                    return true; 
                } 
                return false; 
            } 
     function submits()  
     {  
        if($('.ms-options-wrap button').html()=='请选择所属区域'){
            alert('请选择所属区域');
            return false;
        }

        if($('#xianshi').val() == -1){
            alert('请选择是否启用');
            return false;
        }
         var submitId=document.getElementById('submit');  
         submitId.disabled=true;  
         // document.fm.submit();  
         // setTimeout('var submitId=document.getElementById("submit");submitId.disabled=false;',3000); //代码核心在这里，3秒还原按钮代码
         // return false;
    }  
</script>
<script type="text/javascript">
                                    //弹出图片
                                  
                                    function js_method(id){    
                                    document.getElementById("tcbg").style.display="block";
                                    document.getElementById("cccc").style.display="block";
                                    document.getElementById("img").src=arr_img[id];
                                  
                                    }


                                   

                                    function removeElement1(){
                                    document.getElementById("tcbg").style.display='none';
                                    document.getElementById("cccc").style.display="none";
                                    }
                                    </script>


<style>
    select{
        text-indent:10px;
    }
    input{
              text-indent:10px;
    }
</style>

    <section class="content-body">
        <div class="row">
            <div class="col-md-12">
                <div class="div-box">
                <div class="div-center"><!--/*居中*/-->

                <div class='left' style='float:left'>
                    <form action="<?php echo U('Shequ/add');?>" method="post" enctype="multipart/form-data" onsubmit="return submits();">
                        <div class="box-body" >
                         <div class="form-group">
                                <label for="inputCover">小区名称</label>
                                <input class="ip" type="text" name="mingcheng" autocomplete="off"  class="form-control" id="keyword" style="background:#f9f9f9;"  placeholder="请输入小区名称" maxlength="" />
 
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="inputSubject">坐标</label>
                                <input class="ip" type="text" name="zuobiao" id="zuobiao" placeholder="" maxlength="" style="background:#f9f9f9;" /><br />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">楼栋</label>
                                <input class="ip" type="text" name="loudong" id="" placeholder="请输入楼栋号" maxlength="" /><br />
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">住户</label>
                                <input class="ip" type="text" name="zhuhu" id="" placeholder="请输入住户数" maxlength="" /><br />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">小区地址</label>
                                <input class="ip" type="text" name="weizhi" id="weizhi" placeholder="请输入小区地址" maxlength="" /><br />
                            </div><br><br>

                            <div class="form-group">
                                <label for="inputSubject">物业公司</label>
                                <input class="ip" type="text" name="wuye" id="" placeholder="请输入物业公司" maxlength="" /><br />
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">联系人</label>
                                <input class="ip" type="text" name="lianxiren1" id="" placeholder="请输入联系人姓名" maxlength="" /><br />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">联系电话</label>
                                <input class="ip" type="text" name="dianhua" id="" placeholder="请输入联系电话" maxlength="" /><br />
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSubject">物业地址</label>
                                <input class="ip" type="text" name="wuyedizhi" id="" placeholder="请输入办公地址" maxlength="" /><br />
                            </div>
                            <br><br>

                            <div class="form-group">
                                <label for="inputSubject">行政辖区</label>
                                <input class="ip" type="text" name="xiaqu" id="xiaqu" placeholder="请输入行政辖区" maxlength="" oninput="getXiaqu(this)" onpropertychange="getXiaqu(this)" list="country"/><br />
                                <datalist id="country">
                                </datalist>
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">联系人</label>
                                <input class="ip" type="text" name="lianxiren2" id="lianxiren2" placeholder="请输入联系人姓名" maxlength="" /><br />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">联系电话</label>
                                <input class="ip" type="text" name="dianhua2" id="dianhua2" placeholder="请输入联系电话" maxlength="" /><br />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">办公地址</label>
                                <input class="ip" type="text" name="dizhi2" id="dizhi2" placeholder="请输入办公地址" maxlength="" /><br />
                            </div><br><br>
                             <!--少了一个 </div> -->
<!-- 
                            <div class="form-group">
                                <label for="inputSubject">所属区</label>
                                <input class="ip" type="text" name="abc" id="abc" placeholder="" maxlength="" /><br />
                            </div> -->

<link href="/Public/Admin/box/skin.css" type="text/css" rel="stylesheet" />
<link href="/Public/Admin/box/jquery.multiselect.css" type="text/css" rel="stylesheet" />
<script src="/Public/Admin/box/jquery.js"></script>
<script src="/Public/Admin/box/jquery.multiselect.js"></script>

<!--                             <div class="form-group">
                                <label for="inputSubject">所属区域</label>
                               
                                <select class="ip" name="quyu" id="quyu">
                                      <option  value="0">请选择所属区域</option>
                                      <?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$areas): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($areas['id']); ?>"><?php echo ($areas['mingcheng']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>

                                <select name="quyu[]" id="quyu" multiple="multiple" class="demo1">
                                    
                                </select>

                            </div> -->


 <link href="/Public/Admin/add/zyzn_1.css" rel="stylesheet" />
    <script>
            var znhycode=<?php echo ($area); ?>;
    </script>
    <script src="/Public/Admin/add/hgz_hycode.js"></script>


          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">所属区域</label>
                                <input type="text" id="quyutxt" name="quyutxt" class="nation ip" value="" placeholder="请选择所属区域" data-value="" data-id=""  onclick="appendhybar(this,'duoxuan','quyu')"/>
                                <input type="hidden" id="quyu" name="quyu">
                            </div>
    <script>
      // addhyitem($("[data-id='3413']"));
      appendhybar($('#quyutxt'),'duoxuan','quyu');
      <?php if(is_array($quyu)): $i = 0; $__LIST__ = $quyu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$q): $mod = ($i % 2 );++$i;?>$('input[data-id="<?php echo ($q); ?>"]').prop("checked",true);
        addhyitem($('input[data-id="<?php echo ($q); ?>"]'));<?php endforeach; endif; else: echo "" ;endif; ?>
      svae_hyitem();
    </script>

<script>
   $('#quyu').multiSelect({
    placeholder: '请选择所属区域'
  });
</script>




                            <div class="form-group">
                                <label for="inputSubject">是否启用</label>
                                      <select class="ip" id="xianshi" name="xianshi">
                                      <option  value="-1">请选择</option>
                                      <option  value="1">是</option>
                                      <option  value="0">否</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">启用时间</label>
                                <input class="ip" type="text" id="" disabled="disabled"style="background:#f9f9f9;" placeholder="自动获取启用时间" maxlength="" value="<?php echo date('Y-m-d H:s:i');?>"/>
                            </div>
                       

                        <!-- /.box-body -->
                        <div class="boxclearfix">
                           <!--  <a href="<?php echo U('edit', ['user_id'=>$user['id']]);?>" class="btn btn-default" title="编辑"><span class="fa fa-edit"></span> 编辑</a> -->
                            <button class="btn btn-primary0"  type="submit" id = "submit" name="submit" onclick="return confirmAct();" value="publish">新增</button>
                            <!-- <button class="btn btn-info" type="submit" name="submit" value="save">仅保存</button> -->
                        </div><!-- /.box-footer -->
                        </div>
                 
                    </div>





<!--弹出图片-->
<style type="text/css">
#tinybox{position:absolute; display:none; padding:10px;  z-index:2000;}
#tinymask{position:absolute; display:none; top:0; left:0; height:100%; width:100%; z-index:1500;background-color:#000;}
#tinycontent{background:#ffffff; font-size:1.1em;}
</style>


<style>
.tcbg{  display:none;  position:fixed;  top: 0%;  left: 0%;  width: 100%;  height: 100%;  background-color:#000;   -moz-opacity: 0.5;  opacity:.50;  filter: alpha(opacity=50); z-index:5}
.cccc{
    display:none;  position:fixed;  top:200px; right:350px; margin:auto; text-align:left;   width: 100%; max-width:600px;  height: 300px;  background-color:#F8F8F8;  z-index:6; border-radius:5px;}


    </style>



<style type="text/css">
#preview{/* width:260px;height:190px; *//*border:1px solid #000;*/overflow:hidden;}
#imghead {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);}
</style>
<script type="text/javascript">
      //图片上传预览    IE是用了滤镜。
        function previewImage(file,id)
        {
          var MAXWIDTH  = 260; 
          var MAXHEIGHT = 180;
          var div = document.getElementById('preview'+id);
          if (file.files && file.files[0])
          {
              div.innerHTML ='<a href="javascript:void(0)" id="click_pic'+id+'" onclick="click_pic('+id+')"><img id=imghead'+id+'></a>';
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
            div.innerHTML = '<img id=imghead'+id+'>';
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





<!-- 调用的js--> 
 <script type="text/javascript" src="/Public/Admin/js/tinybox.js"></script>

    <div class='right' style="width:210px;float:left">
    <div id="content1">
           <!--  <div id="images">
                <a href="#" id="click_pic1"> <!--click_pic1 click_pic2-->
                <!--  <img src="/lebang13/Upload/haizi.jpg" style="width:200px;height:200px"> 
                </a>
            </div> --> 

            <div id="preview1" style="margin-top:2px;margin-left:15px;">
                <a href="javascript:void(0)" id="click_pic1" onclick="click_pic(1)">
                <img id="imghead1" width=210 height=142 border=0 src='/img/sfm.png'>
                </a>
            </div>
            <font style="margin-left:15px;">上传封面图</font>
             <input class="tou-input" type="file" name="pic[]" id="inputCover" onchange="previewImage(this,1)" class="input" style="margin-left:15px;" />
           
            <div id="preview2" style="margin-top:120px; margin-left:15px;">
                <a href="javascript:void(0)" id="click_pic2" onclick="click_pic(2)">
                <img id="imghead2" width=210 height=142 border=0 src='/img/swy.png'>
                </a>
            </div>
            <font style="margin-left:15px;">上传物业图</font>
             <input class="tou-input" type="file" name="pic[]" id="inputCover" onchange="previewImage(this,2)" class="input" style="margin-left:15px;" />
            
          
          <div id="preview3" style="margin-top:68px;margin-left:15px; ">
                <a href="javascript:void(0)" id="click_pic3" onclick="click_pic(3)">
                <img id="imghead" width=210 height=142 border=0 src='/img/sjw.png'>
                </a>
            </div>
           <font style="margin-left:15px;">上传居委会图</font>
             <input class="tou-input" type="file" name="pic[]" id="inputCover" onchange="previewImage(this,3)" class="input"  style="margin-left:15px;"/>
       </div>
       </div>


<script type="text/javascript">

    function click_pic(id){
        var a1 = document.getElementById('click_pic'+id);
        var click_pic = "<img src='"+ a1.children[0].src +"' />";
        TINY.box.show(click_pic,0,0,0,1);
    }

 
</script> 

<div class="clearfix"></div>







                </div><!-- /.box -->
                        <br>
                        <br>
                        <br>
                   </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    </section><!-- /.content -->

<div class="cccc" id="cccc">
    <img  id="img"  onclick="removeElement1()" src="" alt="tupian">
</div>

<section class="content-footer">
        <div class="text-center">
        </div>

    </section><!-- /.content-footer -->
  
                        <script type="text/javascript">
                            var windowsArr = [];
                            var marker = [];
                            var mapObj = new AMap.Map("mapContainer", {
                                    resizeEnable: true,
                                    //center: [116.397428, 39.90923],//地图中心点
                                    zoom: 13,//地图显示的缩放级别
                                    keyboardEnable: false
                            });
                            AMap.plugin(['AMap.Autocomplete','AMap.PlaceSearch'],function(){
                              var autoOptions = {
                                //city: "北京", //城市，默认全国
                                input: "keyword"//使用联想输入的input的id
                              };
                              autocomplete= new AMap.Autocomplete(autoOptions);
                              var placeSearch = new AMap.PlaceSearch({
                                    //city:'北京',
                                    map:mapObj
                              })
                              AMap.event.addListener(autocomplete, "select", function(e){
                                 //TODO 针对选中的poi实现自己的功能
                                 placeSearch.search(e.poi.name)
                                 console.log(e);
                                 document.getElementById("zuobiao").value = e.poi.location.lng + ',' + e.poi.location.lat;
                                 document.getElementById("weizhi").value = e.poi.district+e.poi.address;
                                 //$('#abc').val(e.poi.district);
                                 getAjax(e.poi.district);
                              });
                            });

    function getAjax(addr){
		//$.ajax拼接data的异步请求
		$.ajax({   
		    url:"<?php echo U('Shequ/getArea');?>",   
		    type:'post',   
		    data:'addr=' + addr, 
		    async : false, //默认为true 异步   
		    error:function(){   
		       alert('error');   
		    },   
		    success:function(data){
		        $('#quyu').empty();
                $('.ms-options ul').empty();
		       for(var i=0;i<data.length;i++){
		       	$("#quyu").append("<option value='"+data[i].id+"'>"+data[i].mingcheng+"</option>");
                if(i==0){
                    $('.ms-options ul').append('<li><label for="ms-opt-'+(i+1)+'" style="padding-left: 23px;"><input type="checkbox" value="'+data[i].id+'" title="'+data[i].mingcheng+'" id="ms-opt-1"  onclick="abc(this)">'+data[i].mingcheng+'</label></li>');
                }else{
                    $('.ms-options ul').append('<li><label for="ms-opt-'+(i+1)+'" style="padding-left: 23px;" onclick="abc(this)"><input type="checkbox" value="'+data[i].id+'" title="'+data[i].mingcheng+'" id="ms-opt-'+data[i].id+'">'+data[i].mingcheng+'</label></li>');
                }

		       }
		    }
		});
    }


    function abc(obj){
        if(obj.title == ''){
            if($('#quyu option[value='+$(obj).children("input")[0].value+']').attr('selected') == 'selected'){
                $('#quyu option[value='+$(obj).children("input")[0].value+']').attr('selected',false)
                console.log($('#quyu option[value='+$(obj).children("input")[0].value+']').attr('selected'));
            }else{
                $('#quyu option[value='+$(obj).children("input")[0].value+']').attr('selected',true);
                console.log($('#quyu option[value='+$(obj).children("input")[0].value+']').attr('selected'));
            }
            
            
        }else{
            if($('#quyu option[value='+obj.value+']').attr('selected') == 'selected'){
                $('#quyu option[value='+obj.value+']').attr('selected',false)
                console.log($('#quyu option[value='+obj.value+']').attr('selected'));
            }else{
                $('#quyu option[value='+obj.value+']').attr('selected',true)
                console.log($('#quyu option[value='+obj.value+']').attr('selected'));
            }
        }

        var button = '';
        $("#quyu option").each(function(){
            if($(this).attr('selected') == 'selected'){
                button = button + ',' + $(this).html();
            }
        });
        button = button.replace(/^,/gi,'');
        if(button == ''){
            $('.ms-options-wrap button').html('请选择所属区域');
        }else{
            $('.ms-options-wrap button').html(button);
        }
        
    }

    // $(function(){
    //     $('#country_name').bind('input propertychange',function(){
    //         if($(this).val()==''){return ;}
    //         getXiaqu($(this).val());
    //     });
    // });

    function getXiaqu(addr){
            var xhr = new XMLHttpRequest();
            var xiaqu_data = '';
            if(xhr != null){
                var data = 'addr='+addr.value;
                xhr.open('POST',"<?php echo U('Shequ/getXiaqu');?>",false);
                xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                xhr.onreadystatechange = function(){
                    if(this.readyState ==4){
                        var xiaqu = JSON.parse(this.responseText);
                        xiaqu_data = xiaqu;
                        if(xiaqu.length>0){
                            $('#country').empty();
                            for (var i = 0;i <= xiaqu.length - 1; i++) {
                                $('#country').append('<option value="'+xiaqu[i].xiaqu+'">');
                            }
                        }
                    }
                }
                xhr.send(data);
            }
            if(xiaqu_data.length>0){
                for (var i = 0;i <= xiaqu_data.length - 1; i++) {
                    if(addr.value == xiaqu_data[i].xiaqu){
                        // console.log(xiaqu_data[i].id);
                        $('#lianxiren2').val(xiaqu_data[i].lianxiren);
                        $('#dianhua2').val(xiaqu_data[i].dianhua);
                        $('#dizhi2').val(xiaqu_data[i].dizhi);
                        // $('#imghead').attr('src',xiaqu_data[i].tupian);
                    }
                }
            }
    }

                            //为地图注册click事件获取鼠标点击出的经纬度坐标
    var clickEventListener = mapObj.on('click', function(e) {

        // document.getElementById("lnglat").value = e.lnglat.getLng() + ',' + e.lnglat.getLat();
        // document.getElementById("zuobiao").value = e.location.Lng + ',' + e.location.Lat;
    });
    var auto = new AMap.Autocomplete({
        input: "tipinput"
    });
    AMap.event.addListener(auto, "select", select);//注册监听，当选中某条记录时会触发
    function select(e) {
        if (e.poi && e.poi.location) {
            mapObj.setZoom(15);
            mapObj.setCenter(e.poi.location);
        }
    }
    //s3
     AMap.plugin('AMap.Geocoder',function(){
        var geocoder = new AMap.Geocoder({
            city: "010"//城市，默认：“全国”
        });
        var marker = new AMap.Marker({
            map:mapObj,//改mapObj
            bubble:true
        })
        var input = document.getElementById('input');
        var message = document.getElementById('message');
        mapObj.on('click',function(e){
            marker.setPosition(e.lnglat);
            geocoder.getAddress(e.lnglat,function(status,result){
              if(status=='complete'){
                 input.value = result.regeocode.formattedAddress
                 message.innerHTML = ''
              }else{
                 message.innerHTML = '无法获取地址'
              }
            })
        })
        
        input.onchange = function(e){
            var address = input.value;
            geocoder.getLocation(address,function(status,result){
              if(status=='complete'&&result.geocodes.length){
                marker.setPosition(result.geocodes[0].location);
                mapObj.setCenter(marker.getPosition())
                message.innerHTML = ''
              }else{
                message.innerHTML = '无法获取位置'
              }
            })
        }

    });
    //e

                        </script>





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