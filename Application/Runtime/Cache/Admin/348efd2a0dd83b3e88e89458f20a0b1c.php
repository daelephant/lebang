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
            所有用户
            <a href="<?php echo U('User/add');?>" class="btn btn-default0 pull-right">添加用户</a>
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="<?php echo U('Admin/index');?>"><i class="fa fa-dashboard"></i> 管理中心</a></li>
            <li><a href="<?php echo U('list');?>">用户管理</a></li>
            <li class="active">所有用户</li>
        </ol> -->
    </section>

    <!-- Main content -->
   <!--  <section class="content"> -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- <div class="box-header">
                        <h3 class="box-title"></h3>
                        <a href="<?php echo U('User/add');?>" class="btn btn-default pull-right">添加用户</a>
                    </div> --><!-- /.box-header -->
                    <!--  -->
    
                    <div class="box-body">
                    <form action='<?php echo U('User/fetch');?>' method="get">
        
            <?php
 $starttime = date('Y-m-d',strtotime('-100 days')); $endtime= date('Y-m-d'); ?><table style="margin-left: 10px;margin-top: -5px;margin-bottom: 5px;" border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td style='margin-bottom: 20px'>昵称：<input id="name" name="nickname" class="inp_wid3" type="text" value="<?php echo ($_GET['nickname']); ?>"/></td>
                <td style="text-align:right">&nbsp;手机号：<input id="phone" name="phone" class="inp_wid3" type="text" value="<?php echo ($_GET['phone']); ?>"/></td>
                <td style="text-align:right">&nbsp;身份证号：<input id="idnumber" name="idnumber" class="inp_wid3" type="text" value="<?php echo ($_GET['idnumber']); ?>"/></td>
                <td style="text-align:right">&nbsp;查询日期：<input id="starttime" placeholder="填一个即可2016-08-28" name="starttime" class="inp_wid3" type="date" value="<?php echo ($starttime); ?>"/> ~ <input id="endtime"name="endtime" placeholder="2016-08-29" class="inp_wid3" type="date" value="<?php echo ($endtime); ?>"/></td>
                <td>
                &nbsp;<input class="search_btn1" type="submit" value="搜索" id="Search" />
                </td>
                </tr>
                </table>
      </form>
                        <table class="table table-bordered" style="margin-left: -5px;margin-top: -1px;">
                            <tbody>
                            <tr style="background: #fbfbfb;">
                                <!-- <th style="width: 10px">#</th> -->
                                <th style="text-align:center;">列表</th>  
                                <th style="text-align:center;">昵称</th>
                                <th style="text-align:center;">手机号</th>
                                <th style="text-align:center;">注册时间</th>
                                <th style="text-align:center;">最后登录</th>
                                <th style="text-align:center;">余额</th>
                                 <th style="text-align:center;">用户类型</th>
                                <th style="text-align:center;">操作</th>
                               <!--  <th>性别</th>
                                <th>证件号</th> -->
                               <!--  <th style="width: 20%">操作</th> -->
                            </tr>
                            
                            <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($user['id']); ?></td>
                                <td><?php echo ($user['nickname']); ?></td>
                                <td><?php echo ($user['phone']); ?></td>
                                <td><?php echo ($user['regtime']); ?></td>
                                <td><?php echo ($user['logintimes']); ?></td>
                                <td><?php echo ($user['moneys']); ?></td>
                                <td><?php echo ($user['status']); ?></td>
                                <!-- <td><?php echo ($user['caozuo']); ?></td> -->
                                <!-- <td><?php echo ($User['create_at']); ?></td>
                                <td><?php echo ($User['category_title']); ?></td> -->
                                <td style="width: 135px">
                                    <a href="<?php echo U('edit', ['user_id'=>$user['id']]);?>" class="btn btn-default" title=""  ><!-- <span class="fa fa-edit"></span> --> <?php echo ($user['status']=='雷锋用户'?'查看':'审核'); ?></a>
                                   <a href="<?php echo U('bianji', ['user_id'=>$user['id']]);?>" class="btn btn-default"  title="编辑"><!-- <span class="fa fa-edit" style="width:10px"></span> --> 编辑</a>
                <!-- <form action="<?php echo U('User/recharge');?>" method="post" enctype="multipart/form-data">
                  <input type="text" name="money" id="inputPhone" placeholder="金额" maxlength="5"/>
                  <input type="hidden" name="user_id" value="<?php echo ($user['id']); ?>" />

                  <button type="submit" value="publish" value="充值">充值</button>
                </form> -->
                <!-- <form action="<?php echo U('User/recharge');?>" method="get" id="tform">
                    <input type="text" name="value">
                    <a href="<?php echo U('recharge', ['user_id'=>$user['id']]);?>" onclick="document.getElementByid('tform').submit()">充值</a>
                </form> -->
                                    <!-- <a href="<?php echo U('', ['user_id'=>$user['id']]);?>" class="btn btn-default" title="审查"><span class="fa fa-edit"></span> 审查</a> -->
                                    <!-- <a href="<?php echo U('recharge', ['user_id'=>$user['id']]);?>" class="btn btn-default" title="充值" onclick="disp_prompt()"> 充值</a> -->
                <!-- <form action='<?php echo U('User/recharge');?>' method="get">
                                    <input type="button" onClick="disp_prompt()" value="充值" type="submit"/>

                                    
                                    <script type="text/javascript">
                                      function disp_prompt()
                                      {
                                        var value=prompt("请输入充值金额：","");
                                      
                                        if (value!=null && value != "")
                                        {
                                         
                                            alert("您好！\n\n您充值的金额为:"+ value +"元。");
                                        
                                        }
                                      }
                                      </script>
                </form> -->
                <!--  <form action='<?php echo U('User/recharge');?>' method="get">
                <input id="name" name="name" class="inp_wid3" type="text" value="<?php echo ($_GET['name']); ?>"/></td>
                <input class="search_btn1" type="submit" value="搜索" id="Search" />
                </form> -->

                                   
                                    
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
                  <!--分页的位置-->
                    <?php echo ($page_html); ?>
            </div>
        </div>
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