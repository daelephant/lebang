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
            <font class="font">认证商户</font>
             <a href= "javascript:history.back(-1);" class="btn btn-default0 pull-right"  style="position:relative;bottom:8px;">返回商户列表</a>
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
         var submitId=document.getElementById('submit');  
         submitId.disabled=true;  
         // document.fm.submit();  
         // setTimeout('var submitId=document.getElementById("submit");submitId.disabled=false;',3000); //代码核心在这里，3秒还原按钮代码
         // return false;
    }  
</script>
<script type="text/javascript">
                          /*  弹出禁用框*/
                                 function add(xid){
                                    document.getElementById("tcbg").style.display="block";
                                    document.getElementById("tcdiv").style.display="block";
                                    document.getElementById("xid").value="xid";
                                    document.getElementById("status").value='1';
                                    }
                                    


                                    function subs(){
                                    var beizhu=document.getElementById("beizhu").value;
                                    var xid=document.getElementById("xid").value;//
                          
                                   
                                       

                                    }
                                    function cancel(){
                                    var p=document.getElementById("div");
                                    document.body.removeChild(p);
                                    }
                                      //9月19号修改
                                    function removeElement1(){
                                    document.getElementById("tcbg").style.display='none';
                                    document.getElementById("tcdiv").style.display="none";
                                    }
     </script>


<style>
    select{
        padding-left:5px;
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
                    <form action="<?php echo U('Shanghu/add');?>" method="post" enctype="multipart/form-data" onsubmit="return submits();">
                        <div class="box-body">
                            
                             <div class="form-group">
                                <label for="inputCover">用户手机</label>
                                <input class="ip" type="text" name="phone" id="inputPhone" placeholder="请输入手机号码" maxlength="11" />
                            </div>
                      
                            <div class="form-group">
                                <label for="inputSubject">昵称</label>
                                <input class="ip" type="text" name="nickname" id="inputname" placeholder="请输入昵称" maxlength="" />
                           </div>

                            <div class="form-group">
                                <label for="inputSubject">职业</label>
                                      <select class="ip" name="profession">

                                      <option name="profession" value="">请选择职业</option>
                                      <?php if(is_array($master_list)): foreach($master_list as $key=>$vo): ?><option name="profession" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["mname"]); ?></option><?php endforeach; endif; ?>
                                      </select>
                            </div>

                             <div class="form-group">
                                <label for="inputSubject">所在小区</label>
                                <select class="ip" name="mingcheng">

                                      <option name="profession" value="">请选择所在小区</option>
                                      <?php if(is_array($master_list)): foreach($master_list as $key=>$vo): ?><option name="profession" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["mname"]); ?></option><?php endforeach; endif; ?>
                                      </select>
                           </div>



                   
                        <div class="form-group" style="margin-top:10px;">
                                <label for="inputCover">真实姓名</label>
                                <input class="ip" type="text" name="name" id="inputPhone" placeholder="请输入真实姓名" maxlength="" />
                            </div>

                         <div class="form-group">
                                <label for="inputCover">性别</label>
                                <select name="" id="" class='ip'>
                                  <option value="0">请选择</option>
                                  <option value="1">男</option>
                                  <option value="2">女</option>
                                </select>
                            </div>

                          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">生日</label>
                                <input class="ip" type="date" name="name" id="inputPhone" placeholder="" maxlength="" />
                            </div>

                          <div class="form-group" style="margin-top:10px;">
                                <label for="inputCover">身份证号</label>
                                <input class="ip" type="text" name="" id="inputPhone" placeholder="请输入身份证号" maxlength="" />
                            </div>
  
    

                        <div class="form-group" style="margin-top:20px;">
                                <label for="inputCover">店铺名称</label>
                                <input class="ip" type="text" name="name" id="inputPhone" placeholder="请输入店铺名称" maxlength="" />
                            </div>
                        <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">客服电话</label>
                                <input class="ip" type="text" name="name" id="inputPhone" placeholder="请输入客服电话" maxlength="" />
                            </div>

                        <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">服务时间</label>
                                <input class="ip" type="text" name="name" id="inputPhone" placeholder="请选择服务时间" maxlength="" />
                            </div>

                        </div>
                   </div>
                  
  
<!-- 调用的js--> 
 <script type="text/javascript" src="/Public/Admin/js/tinybox.js"></script>

    <div class='right' style="width:450px;float:left">
    <div id="content">
           

            <div id="preview1" style="margin-top:1px; ">
                <a href="javascript:void(0)" id="click_pic1" onclick="click_pic(1)">
                <img id="imghead" style="width:140px; height:140px;"  border=0 src='/img/haizi.jpg'>
                </a>
            </div>
            上传头像
             <input type="file" class="tou-input" onchange="previewImage(this,1) " style="width:200px" />
            <br>
            <br>
            
             <div id="preview2" style="margin-top:30px; ">
                <a href="javascript:void(0)" id="click_pic2" onclick="click_pic(2)">
                <img id="imghead" style="width:140px; height:140px;" border=0 src='/img/haizi.jpg'>
                </a>
            </div>
            上传身份证照
            <input type="file" class="tou-input" onchange="previewImage(this,2)"  style="width:200px"/> 

            <br>
            <br>
                    
            <div style="margin-top:35px;">
            <div id="preview3" style="float: left;width:200px;">
                <a href="javascript:void(0)" id="click_pic3" onclick="click_pic(3)">
                <img id="imghead" style="width:140px; height:140px;" border=0 src='/img/haizi.jpg'>
                </a><br>
                上传店铺封面
                <input type="file" class="tou-input" onchange="previewImage(this,3)" class="input" style="width:200px"/>
            </div>
            

       
              <div id="preview4" style="float: left;width:200px;padding-left:5px">
                <a href="javascript:void(0)" id="click_pic4" onclick="click_pic(4)">
                <img id="imghead" style="width:140px; height:140px;" border=0 src='/img/haizi.jpg'>
                </a><br>
                上传营业执照
                <input type="file" class="tou-input" onchange="previewImage(this,4)" class="input" style="width:200px"/>
            </div>

            </div>
            
          </div>
       </div>
      <div style="clear: both;"></div>
  
          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">服务项目</label>
                                <select name="" id="" class='ip' style="width:655px;">
                                  
                                  <option value="">请选择服务项目</option>
                                  </select>
                            </div>
          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">服务区域</label>
                                <select name="" id="" class='ip' style="width:655px;"> 
                                  <option value="">请选择服务区域</option>
                                </select>
                            </div>
          <div class="form-group" style="margin-top:5px;">
                                <label for="inputCover">店铺地址</label>
                                <input class="ip" type="text" name="name" id="inputPhone" placeholder="请输入店铺地址" maxlength="" style="width:655px;"/>
                            </div>
          <div class="form-group">
                                <label for="inputSubject"  style="height:80px;line-height:80px; position: relative;top: 1px; ">店铺简介</label>
                                <!-- <input class="ip" type="text" name="nickname" id="inputname" placeholder="请输入昵称" maxlength=""   style="height:80px;width:558px;"/> -->
                                <textarea name="" id="" cols="30" rows="10" style="height:80px;width:655px;position: relative;left:-8px;top: 1px;border:#dddddd solid 1px;resize: none ;color:#666;" placeholder="请输入店铺地址"> 
                                </textarea>
                            </div>

                            <div class="boxclearfix">

                            <button class="btn btn-primary0"  type="button" onclick="add();" style="width:150px;background:#ff6600;border:#ff6600;">禁用</button>

                            <button class="btn btn-primary0"  type="button" id = "submit" name="submit" onclick="zhiding();" value="publish" style="width:150px; background:#0099ff;;border:#0099ff;margin-left:10px;">推荐</button>
                            
                              <input type="hidden" name="xinxianshi_id" value="<?php echo ($xinxianshi['id']); ?>"> 
                            <button class="btn btn-primary0"  type="submit" id = "submit" name="submit" onclick="return confirmAct();" value="publish" style="width:400px;margin-left:10px; ">保存</button>
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
#tinymask{position:absolute; display:none; top:0; left:0; height:100%; width:100%; z-index:1500;}
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
          var MAXWIDTH  = 260; 
          var MAXHEIGHT = 180;
          var div = document.getElementById('preview'+id);
          if (file.files && file.files[0])
          {
              div.innerHTML ='<a href="javascript:void(0)" id="click_pic'+id+'" onclick="click_pic('+id+')"><img id=imghead></a>';
              var img = document.getElementById('imghead');
              img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
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
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
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
                        <br>
                        <br>
                        <br>
                   </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    </section><!-- /.content -->

<style>
.tcbg{  display:none;  position:fixed;  top: 0%;  left: 0%;  width: 100%;  height: 100%;  background-color:#000;   -moz-opacity: 0.5;  opacity:.50;  filter: alpha(opacity=50); z-index:5}
.tcdiv{ display:none;  position:fixed;  top:200px; right:350px; margin:auto; text-align:left;   width: 100%; max-width:400px;  height: 280px;  background-color:#F8F8F8;  z-index:6; padding:10px; border-radius:5px;}

.int{
    width:100%;
    }
 #we{
    float:right;
    margin-top:20px;
    
    }
    textarea{
        resize:block; width:380px; height:160px; border-radius:3px;
    }
  /*  select{
        width:380px;height:35px;margin-top:5px; border-radius:3px;
    }*/

    </style>
<div class="tcbg" id="tcbg"></div>
<div id="tcdiv"  class="tcdiv">
<form action="" method="get">
    <input type="hidden" placeholder="备注信息" id="xid"  name="tixian_id" > 
    <textarea name="" id="beizhu" name=" " placeholder="输入不禁用的理由......"cols="30" rows="10"></textarea>
     <select id="zhuqi" name=" " style="width:380px;height:35px;margin-top:5px; border-radius:3px;  color:#a9a9a9">
       <option  name =" " value="" >选择禁用周期</option>
       <option  name ="" value="1">&nbsp;24小时</option>
       <option  name="" value="2">&nbsp;3天</option>
       <option  name="" value="3">&nbsp;7天</option>
       <option  name="" value="4">&nbsp;1个月</option>
       <option  name="" value="5">&nbsp;永久禁用</option>
     </select>
    <input  type="hidden"  placeholder="备注信息" id="status"  name="status" >
     <div id="we">
    <input type='button' class="btn btn-default0" style="background:#FFFFFF;border-color: #fbfbfb;color:black; " onclick="removeElement1()" value='取消'>&nbsp;&nbsp;

       <input type="submit" class="btn btn-default0" style="background:#FF6600;"; value="确定禁用">
    </div>
 </form>
</div>

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