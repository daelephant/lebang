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
        <div>
            <div style="float:left">
            <font class="font" >任务详情</font>  
            <!-- <p style="width:81px;23px;">待审核用户 </p> -->
          
            </div>
        <div class="search" style="float:left;margin-left: 20px;">
</div>
      <a href="javascript:history.back(-1);" class="btn btn-default0 pull-right"  style="position:relative;bottom:8px;">返回</a>
  
        </div>
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
<style>
    select{
        text-indent:5px;
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
                    <form action="<?php echo U('finishk',['order_id'=>$order['id'],'p'=>$_GET['p']]);?>" method="post" enctype="multipart/form-data" onsubmit="return submits();">
                        <!-- <div class="box-header">
                            <h3 class="box-title"></h3>
                            <a href="<?php echo U('User/list');?>" class="btn btn-default pull-right">用户列表</a>
                        </div> --><!-- /.box-header -->
                
                        <div class="box-body">
                          <div>
                              <div class="form-group" style="float:left; ">
                                <label for="inputCover">任务编号</label>
                                <input class="ip" type="text" readonly="readonly" name="ordernum" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['ordernum']); ?>" />
                            </div>

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">任务状态</label>
                                  <input class="ip" type="text" disabled="disabled" name="status" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9; color:#FF9900;"
                                   <?php if($order['status'] == 5): ?>value="取消"/> 
                                      <?php elseif($order['status'] == 4): ?> value="完成"/><?php endif; ?>
                            
                            </div>
                         </div>
                            
                            <div class="form-group">
                                <label for="inputSubject"  style="height:80px;line-height:80px; position: relative;top: 1px; ">用户需求</label>
                                <!-- <input class="ip" type="text" name="nickname" id="inputname" placeholder="请输入昵称" maxlength=""   style="height:80px;width:558px;"/> -->
                                <textarea name="demand" id="" cols="30" rows="10" style="height:80px;width:558px;position: relative;left:-8px;top: 1px;border:#dddddd solid 1px;resize: none ;color:#666;" > <?php echo ($order['demand']); ?> 
                                </textarea>
                            </div>
                         <script type="text/javascript" src="/Public/Admin/js/tinybox.js"></script>
                        
                            <div class="form-group"style="margin:0 auto;clear:both;width:640px;height:180px; ">

                            <?php if(is_array($order2)): foreach($order2 as $k=>$order2): ?><div id="preview<?php echo ($k+1); ?>"
                            <?php if($k == 0 OR $k == 3 OR $k == 6): ?>style="margin-top:10px; float:left; margin-left:100px;"
                            <a href="javascript:void(0)" id="click_pic<?php echo ($k+1); ?>" onclick="click_pic(<?php echo ($k+1); ?>)">
                            <?php else: ?>
                            style="margin-top:10px; float:left; margin-left:10px;"><?php endif; ?>
                            <a href="javascript:void(0)" id="click_pic<?php echo ($k+1); ?>" onclick="click_pic(<?php echo ($k+1); ?>)">
                            <img id="imghead<?php echo ($k+1); ?>" width=140px; height=140px; border=0 src='/photo/<?php echo ($path); ?>/<?php echo ((isset($order2["zhaopian"]) && ($order2["zhaopian"] !== ""))?($order2["zhaopian"]):"dingdan.png"); ?>'>
                            </a>
                            </div>
                
                            </if><?php endforeach; endif; ?>
 
                           
                          </div>

      <div style="clear: both; margin-bottom: 20px;"></div>

<script type="text/javascript" >                       
        function click_pic(id){
                var a1 = document.getElementById('click_pic'+id);
                var click_pic = "<img src='"+ a1.children[0].src +"' />";
              TINY.box.show(click_pic,0,0,0,1);
             }

 
</script> 
                          <div>
                              <div class="form-group" style="float:left; ">
                                <label for="inputCover">感谢金</label>
                                <input class="ip" type="text" readonly="readonly" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;color:#FF9900; " value="￥<?php echo ($order['reward']); ?>"/>
                            </div>

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">商品价格</label>
                                <input class="ip" type="text" disabled="disabled" name="phone" id="inputPhone" placeholder="凭购物小票结算" maxlength="11" style="width:240px;background:#f9f9f9;" />
                            </div>
                         </div>
                          
                           <div>
                              <div class="form-group" style="float:left; ">
                                <label for="inputCover">任务时间</label>
                                <input class="ip" type="text" readonly="readonly" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['starttime'] = date("Y-m-d H:s:i", $order['starttime'])); ?>"/>
                            </div>

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">下单时间</label>
                                <input class="ip" type="text" disabled="disabled" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['addtime'] = date("Y-m-d H:s:i", $order['addtime'])); ?>" />
                            </div>
                         </div>

                          <div>
                              <div class="form-group" style="float:left; ">
                                <label for="inputCover">任务地点</label>
                                <input class="ip" type="text" readonly="readonly" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['location']); ?>"/>
                            </div>

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">具体地址</label>
                                <input class="ip" type="text" disabled="disabled" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['address']); ?>" />
                            </div>
                         </div>

                          <div>
                              <div class="form-group" style="float:left; ">
                                <label for="inputCover">发布人</label>
                                <input class="ip" type="text" readonly="readonly" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value ="<?php echo ($order['username']); ?>"/>
                            </div>

                            <div class="form-group" style="float:left; position: relative;left: -9px;">
                                <label for="inputCover">手机号</label>
                                <input class="ip" type="text" disabled="disabled" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['tel']); ?>" />
                            </div>
                         </div>
                         
                           <font style="font-size:20px;">接单人信息</font><br><br>

                      <div  style="float:left;">
                          <div  style="float:left;">
                             <div class="form-group">
                                <label for="inputbirthday">接单人</label>
                                <input class="ip" type="text" disabled="disabled" name="phone" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order1['name']); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">手机号码</label>
                                <input class="ip" type="text" disabled="disabled" name="" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order1['phone']); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">接单时间</label>
                                <input class="ip" type="text" disabled="disabled" name="" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime'])); ?>" />
                            </div>

                            <div class="form-group">
                                <label for="inputSubject">评价星级</label>

                             <div class="ip" style="display:inline-block;top:-2px;text-align:center;width:240px;height:42px;background:#f9f9f9;text-align: left;
text-indent: 10px;"><?php echo ($pfs); ?> <?php echo number_format($order3['fen'],1);?></div>
                                   
                            </div>
                              <?php if($order['status'] == 5): ?><div class="form-group">
                                <label for="inputSubject">取消时间</label>
                                <input class="ip" type="text" disabled="disabled" name="" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['endtime'] = date("Y-m-d H:s:i", $order['endtime'])); ?>" />
                            </div>
                            <?php elseif($order['status'] == 4): ?>

                            <div class="form-group">
                                <label for="inputSubject">完成时间</label>
                                <input class="ip" type="text" disabled="disabled" name="" id="inputPhone" placeholder="" maxlength="11" style="width:240px;background:#f9f9f9;" value="<?php echo ($order['endtime'] = date("Y-m-d H:s:i", $order['endtime'])); ?>" />
                            </div><?php endif; ?>

                             
                            
                      </div>

                          <div style="float:left;margin-left:-95px;margin-top:-9px;">
                            <div id="preview4" style="margin-top:10px; float:left; margin-left:100px;">
                            <a href="javascript:void(0)" id="click_pic4" onclick="click_pic(4)">
                            <img id="imghead1" width=140px; height=140px; border=0 src='/photo/avatar/b_<?php echo ((isset($order1["avatar"]) && ($order1["avatar"] !== ""))?($order1["avatar"]):"avatar.png"); ?>'>
                            </a>
                            </div>
                          </div>
                       </div>

                        <!-- /.box-body -->
                        <div class="boxclearfix">

                            <button class="btn btn-primary0"  type="submit" id = "submit" name="submit" onclick="return confirmAct();" value="publish" style="width:640px;">保存</button>

                        </div>
                        <br>
                        </div>
                 
                 

<!--弹出图片-->
<style type="text/css">
#tinybox{position:absolute; display:none; padding:10px;  z-index:2000;}
#tinymask{position:absolute; display:none; top:0; left:0; height:100%; width:100%; z-index:1500;background:#000000;}
#tinycontent{background:#ffffff; font-size:1.1em;}
</style>

<script type="text/javascript" >                       
        function click_pic(id){
                var a1 = document.getElementById('click_pic'+id);
                var click_pic = "<img src='"+ a1.children[0].src +"' />";
              TINY.box.show(click_pic,0,0,0,1);
             }
</script> 

 </div><!-- /.box -->
     </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    </section><!-- /.content -->
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