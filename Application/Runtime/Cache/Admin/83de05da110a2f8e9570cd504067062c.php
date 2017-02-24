<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <!-- start -->
    
    
    
   
  
    <!-- end -->
    <head>
    <meta charset="UTF-8">
    <title>管理中心_全民乐帮</title>
    <!-- <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> -->
    <!-- 地图 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <!-- bootstrap 3.0.2 -->
    <link href="/lebang18/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" /><!-- 一般 -->
    <!-- font Awesome -->
    <link href="/lebang18/Public/Admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/lebang18/Public/Admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/lebang18/Public/Admin/css/AdminLTE.css" rel="stylesheet" type="text/css" /><!-- 1 -->
    
     <script type="text/javascript" src="/lebang18/Public/js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="/lebang18/Public/ueditor/ueditor.config.js"></script>    
    <script type="text/javascript" src="/lebang18/Public/ueditor/ueditor.all.min.js"></script>
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
    <a href="" class="logo" style="background:#FF6600;"  >
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
                    <ul class="dropdown-menu">
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
                        <li class="user-footer" style=" width:135px; float:right;">
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
 $url = CONTROLLER_NAME.'/'.ACTION_NAME; echo "$url"; ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- div class="user-panel">
            <div class="pull-left image">
                <img src="/lebang18/Public/Admin/img/avatar3.png" class="img-circle" alt="User Image" />
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
             <li class="treeview <?php if($url == "User/list" OR $url == "User/list1" OR $url == "User/list2" OR $url == "User/list3" OR $url == "User/list4" OR $url == "User/fetch" OR $url == "User/add" OR $url == "User/bianji" OR $url == "User/edit" OR $url == "User/recharge"): ?>active<?php endif; ?>">
                <a href="<?php echo U('User/list');?>">
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
             <!-- <li class="treeview <?php if($url == "Order/list" OR $url == "Order/nopay" OR $url == "Order/liushi" OR $url == "Order/edit" OR $url == "Order/cancel"OR $url == "Order/fetch"): ?>active<?php endif; ?>"> -->
             <li class="treeview active">
                <a href="<?php echo U('Order/list');?>">
                    <i class="fa fa-file"></i> <span>任务管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Order/list');?>"><i class="fa fa-list"></i>任务列表</a></li>
                    <li><a href="<?php echo U('Order/liushi');?>"><i class="fa fa-list"></i>流失的任务</a></li>
                    <li><a href="<?php echo U('Order/nopay');?>"><i class="fa fa-list"></i>未支付的任务</a></li>
                    <li><a href="<?php echo U('Order/cancel');?>"><i class="fa fa-list"></i>取消的任务</a></li>
                </ul>
            </li>
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
            <li class="treeview <?php if($url == "Shequ/list" OR $url == "Shequ/add" OR $url == "Shequ/bianji" OR $url == "Shequ/started" OR $url == "Shequ/starting"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Shequ/list');?>">
                    <i class="fa fa-file"></i> <span>社区管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Shequ/list');?>"><i class="fa fa-list"></i>社区列表</a></li>
                    <li><a href="<?php echo U('Shequ/started');?>"><i class="fa fa-list"></i>启用的小区</a></li>
                    <li><a href="<?php echo U('Shequ/starting');?>"><i class="fa fa-list"></i>待开通小区</a></li>
                    <!-- <li><a href="<?php echo U('Shequ/add');?>"><i class="fa fa-edit"></i>添加社区</a></li> -->
                </ul>
            </li>
             <li class="treeview <?php if($url == "Xinxianshi/list" OR $url == "Xinxianshi/list2" OR $url == "Xinxianshi/list3"OR $url == "Xinxianshi/list4" OR $url == "Xinxianshi/add" OR $url == "Xinxianshi/fetch" OR $url == "Xinxianshi/pingluncheck"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Xinxianshi/list');?>">
                    <i class="fa fa-file"></i> <span>新鲜事管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Xinxianshi/list');?>"><i class="fa fa-list"></i>所有新鲜事</a></li>
                   <!--  <li><a href="<?php echo U('Xinxianshi/list1');?>"><i class="fa fa-list"></i>待审核</a></li> -->
                    <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>在线的新鲜事</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list4');?>"><i class="fa fa-list"></i>屏蔽的新鲜事</a></li>
                   <!--  <li><a href="<?php echo U('Xinxianshi/listx');?>"><i class="fa fa-edit"></i>置顶的新鲜事</a></li> -->
                </ul>
            </li>
             <li class="treeview <?php if($url == "Xinxianshi/list6" OR $url == "Xinxianshi/fetch1" OR $url == "Xinxianshi/list7" OR $url == "Xinxianshi/list5"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Xinxianshi/list');?>">
                    <i class="fa fa-file"></i> <span>评论管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!-- <li><a href="<?php echo U('Xinxianshi/list');?>"><i class="fa fa-list"></i>所有新鲜事</a></li> -->
                   <!--  <li><a href="<?php echo U('Xinxianshi/list1');?>"><i class="fa fa-list"></i>待审核</a></li> -->
                    <!-- <li><a href="<?php echo U('Xinxianshi/list3');?>"><i class="fa fa-list"></i>启用的新鲜事</a></li> -->
                    <li><a href="<?php echo U('Xinxianshi/list6');?>"><i class="fa fa-list"></i>所有评论</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list7');?>"><i class="fa fa-list"></i>在线的评论</a></li>
                    <li><a href="<?php echo U('Xinxianshi/list5');?>"><i class="fa fa-list"></i>已屏蔽的评论</a></li>
                   <!--  <li><a href="<?php echo U('Xinxianshi/add');?>"><i class="fa fa-edit"></i>用户添加</a></li> -->
                </ul>
            </li>
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
            <li class="treeview <?php if($url == "Quanxian/list" OR $url == "Quanxian/list1" OR $url == "Quanxian/list2"): ?>active<?php endif; ?>">
                <a href="<?php echo U('Quanxian/list');?>">
                    <i class="fa fa-file"></i> <span>权限管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo U('Quanxian/list');?>"><i class="fa fa-list"></i>后台用户</a></li>
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
            查看任务
            <a href="<?php echo U('Order/list');?>" class="btn btn-default pull-right"><font color="black">任务列表</font></a>
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="<?php echo U('Admin/index');?>"><i class="fa fa-dashboard"></i> 管理中心</a></li>
            <li><a href="<?php echo U('list');?>">订单管理</a></li>
            <li class="active">查看订单</li>
        </ol> -->
    </section>

    <!-- Main content -->
    <!-- <section class="content"> -->

        <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo ($CONF['shopTitle']['fieldValue']); ?>后台管理中心</title>
      <link href="/lebang18/Public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="/lebang18/Apps/Admin/View/css/AdminLTE.css" rel="stylesheet" type="text/css" />
      <!--[if lt IE 9]>
      <script src="/lebang18/Public/js/html5shiv.min.js"></script>
      <script src="/lebang18/Public/js/respond.min.js"></script>
      <![endif]-->
      <script src="/lebang18/Public/js/jquery.min.js"></script>
      <script src="/lebang18/Public/plugins/bootstrap/js/bootstrap.min.js"></script>
      <script src="/lebang18/Public/js/common.js"></script>
      <script src="/lebang18/Public/plugins/plugins/plugins.js"></script>
      <script src="/lebang18/Public/plugins/formValidator/formValidator-4.1.3.js"></script>
   </head>
   <body class="wst-page">
       <form name="myform" method="post" id="myform">
        <input type='hidden' id='id' value='<?php echo ($order["bankId"]); ?>'/>
        <table class="table table-hover table-striped table-bordered wst-form">
           <tr>
             <td>
             <span style='font-weight:bold;'>任务号：<?php echo ($order['ordernum']); ?> <!-- <?php echo ($user['name']); ?>  --></span>
             <span style='margin-left:100px;'>
             <form action="<?php echo U('edit', ['order_id'=>$order['id']]);?>" method="post" enctype="multipart/form-data">
                                       当前状态：
                                         <?php if($order["status"] == 0): ?><span style="font-size:18px;color:red">未支付</span>
                                         <?php elseif($order["status"] == 1): ?><span style="font-size:18px;color:red">未接单</span>
                                         <?php elseif($order["status"] == 2): ?><span style="font-size:18px;color:red">已接单</span>
                                         <?php elseif($order["status"] == 3): ?><span style="font-size:18px;color:red">开始</span>
                                         <?php elseif($order["status"] == 4): ?><span style="font-size:18px;color:red">完成</span>
                                         <?php elseif($order["status"] == 5): ?><span style="font-size:18px;color:red">取消</span><?php endif; ?>
            
                                       &nbsp;&nbsp; <input type="radio" name = 'status' value= '0'<?php if($order["status"] == 0): ?>checked<?php endif; ?>>未支付
                                       &nbsp;&nbsp; <input type="radio" name = 'status' value= '1'<?php if($order["status"] == 1): ?>checked<?php endif; ?>>未接单
                                       &nbsp;&nbsp;<input type="radio" name = 'status' value= '2' <?php if($order["status"] == 2): ?>checked<?php endif; ?>>已接单
                                       &nbsp;&nbsp;<input type="radio" name = 'status' value= '3' <?php if($order["status"] == 3): ?>checked<?php endif; ?>>开始
                                       &nbsp;&nbsp;<input type="radio" name = 'status' value= '4' <?php if($order["status"] == 4): ?>checked<?php endif; ?>>完成
                                       &nbsp;&nbsp;<input type="radio" name = 'status' value= '5' <?php if($order["status"] == 5): ?>checked<?php endif; ?>>取消
                                       &nbsp;&nbsp;<button class="btn btn-primary" type="submit" name="submit" value="publish">修改状态</button><br>
                                       <span style='font-weight:bold;'>后台最后操作时间：<?php echo ($order['beizhu'] = date("Y-m-d H:s:i", $order['beizhu'])); ?> <!-- <?php echo ($user['name']); ?>  --></span>

                                       </form>


             <!--   <?php if($order["status"] == 1): ?>未接单
               <elseif condition='$order["status"] eq 2'>已接单
               <?php elseif($order["status"] == 3): ?>开始
               <?php elseif($order["status"] == 4): ?>完成
               <?php elseif($order["status"] == 5): ?>取消<?php endif; ?> -->
             </span></td>
           </tr>
           <tr>
              <td style='font-weight:bold;'>任务日志</td>
           </tr>
           <tr>
              <td>
                <table width='100%'>
                <tr><!-- ##$user['logintimes'] = date("Y-m-d", $user['logintimes']);## -->
                  <td width='800'>下单时间:<?php echo ($order['addtime'] = date("Y-m-d H:s:i", $order['addtime'])); ?></td>
                  <td width='800'>开始时间:<?php echo ($order['starttime'] = date("Y-m-d H:s:i", $order['starttime'])); ?></td>
                  <td width='600'>接单人:<?php echo ($order1['username1']); ?></td>
                  <td width='800'>接单时间:<?php echo ($order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime'])); ?></td>
                  <td width='800'>完成时间:<?php echo ($order['endtime'] = date("Y-m-d H:s:i", $order['endtime'])); ?></td>
                </tr>
                <!-- <?php if(is_array($order['log'])): $i = 0; $__LIST__ = $order['log'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?>-->
                <!-- <tr> -->
                  <!-- <td><?php echo ($order['ordernum']); ?></td>
                  <td><?php echo ($order['starttime']); ?></td>
                  <td><?php echo ($order['jdopenid']); if(!empty($log['shopName'])): ?>(<?php echo ($log['shopName']); ?>)<?php endif; ?></td>
                  <td>111<?php echo ($order['jdtime']); ?></td>
                  <td><?php echo ($order['endtime']); ?></td>
                </tr> -->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?> -->
                </table>
              </td>
           </tr>
           <tr>
             <td style='font-weight:bold;'>任务信息</td>
           </tr>
           <tr>
             <td>
             <table width='100%'>
                
                <tr>
                  <td style='text-align:center'>支付成功时间：<?php echo ($order['paytime'] = date("Y-m-d H:s:i", $order['paytime'])); ?></td>
                  
                </tr>
                
             </td>
           </tr>
           <?php if($order["tk"] == 1): ?><tr>
             <td style='font-weight:bold;'>原路退回</td>
           </tr>
          
           <elseif condition='$order["tk"] eq 2'>退款到余额<?php endif; ?>
          
           <tr>
             <td style='font-weight:bold;'>下单人信息</td>
           </tr>
           <tr>
             <td>
                <table width='700'>
                <tr>
                  <!-- <a href="{echo $order_list}">测试</a> -->
                  <td width='350' style='text-align:right'>下单用户：</td>
                  <td><?php echo ($order['username']); ?></td>
                </tr>
                <!-- <tr>
                  <td width='350' style='text-align:right'>用户名：<?php echo ($order['openid']); ?></td>
                  <td><?php echo ($order['oname']); ?></td>
                </tr> -->
               <!--  <tr>
                  <td style='text-align:right'>地址：</td>
                  <td><?php echo ($order['address']); ?></td>
                </tr> -->
                <tr>
                  <td style='text-align:right'>联系电话：</td>
                  <td><?php echo ($order['tel']); ?></td>
                 <!--  <td>
                  <notmpty name='order['userPhone']'>
                  <?php echo ($order['userPhone']); ?>
                  </notmpty>
                  <notmpty name='order['userTel']'>
                  <?php echo ($order['userTel']); ?>
                  </notmpty>
                  </td> -->
                </tr>
                </table>
             </td>
           </tr>
           <tr>
              <td style='font-weight:bold;'>需求信息</td>
           </tr>
           <tr>
              <td>
                <table width='100%'>
                <tr>
                  <td width='100%' colspan='2'>需求:<?php echo ($order['demand']); ?></td>
                  
                </tr>
                <tr>
                  <td width='350'>赏金:<?php echo ($order['reward']); ?></td>
                  <!-- <td width='130'>数量:</td> -->
                  
                </tr>
                <tr>
                  <td width='130'>总金额:<?php echo ($order['money']); ?></td>
                </tr>
               <!--  <?php if(is_array($order['goodslist'])): $i = 0; $__LIST__ = $order['goodslist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?><tr>
                  <td width='50'><img src='/lebang18/<?php echo ($goods["goodsThums"]); ?>' style='margin:2px;' width='50' height='50'/></td>
                  <td width='120'><?php echo ($goods["goodsName"]); ?></td>
                  <td width='350'>￥<?php echo ($goods["goodsPrice"]); ?></td>
                  <td width='130'><?php echo ($goods["goodsNums"]); ?></td>
                  <td width='130'>￥<?php echo ($goods["goodsPrice"]*$goods["goodsNums"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?> -->
                </table>
              </td>
           </tr>
           <!-- <tr>
              <td style='text-align:right;padding-right:10px;'>商品总金额：￥<?php echo ($order['totalMoney']); ?><br/>+ 运费：￥<?php echo ($order['deliverMoney']); ?><br/><span style='font-weight:bold;font-size:20px'>订单金额：</span><span style='font-weight:bold;font-size:20px;color:red;'>￥<?php echo ($order['totalMoney']+$order['deliverMoney']); ?></span></td>
           </tr> -->
           <tr>
             <td colspan='2' align='center'>
                 <!-- <button type="button" class="btn btn-primary" onclick='javascript:location.href="<?php echo ($referer); ?>"'>返&nbsp;回</button> -->
                 <a href="<?php echo U('Order/list');?>" class="btn btn-primary">返&nbsp;回</a>
             </td>
           </tr>
        </table>
       </form>
   </body>
    </section><!-- /.content -->

    <section class="content-footer">
        <div class="text-center">
            &copy;全民乐帮
        </div>
    </section><!-- /.content-footer -->

</aside><!-- /.right-side -->

            
        </div><!-- ./wrapper -->

        <!-- jQuery 2.0.2 -->
        <script src="/lebang18/Public/Admin/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/lebang18/Public/Admin/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/lebang18/Public/Admin/js/app.js" type="text/javascript"></script>


    </body>
</html>