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
            所有新鲜事
        </h1>
        <ol class="breadcrumb">
             <form action='<?php echo U('Xinxianshi/fetch');?>' method="get">
                <tr>
                <td style='margin-bottom: 20px'>发帖人：<input id="name" name="name" class="inp_wid3" type="text" value=""/></td>
                <td style='margin-bottom: 20px'>内容：<input id="neirong" name="neirong" class="inp_wid3" type="text" value=""/></td>
                <td>
                &nbsp;<input class="search_btn1" type="submit" value="搜索" id="Search" />
                </td>
                </tr>    
            </form>
        </ol>
    </section>
                             <!-- //s -->
                                    <script type="text/javascript">
                                    function add(xid){
                                    document.getElementById("tcbg").style.display="block";
                                    document.getElementById("tcdiv").style.display="block";
                                    document.getElementById("xid").value=xid;
                                    }


                                    function subs(){
                                    var beizhu=document.getElementById("beizhu").value;//
                                    var xid=document.getElementById("xid").value;//
                          
                                   
                                       

                                    }
                                    function cancel(){
                                    var p=document.getElementById("div");
                                    document.body.removeChild(p);
                                    }
                                    //9月19号修改
                                    function removeElement(){
                                    document.getElementById("tcbg").style.display='none';
                                    document.getElementById("tcdiv").style.display="none";
                                    }
                                    </script>
    <!-- Main content -->
    <!-- <section class="content"> -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <!-- <a href="<?php echo U('Xinxianshi/add');?>" class="btn btn-default pull-right">添加新鲜事</a> -->
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <table style="margin-left: -5px;margin-top: -25px;" class="table table-bordered">
                            <tbody>
                            <tr style="background: #fbfbfb;">
                                <!-- <th style="width: 10px">#</th> -->
                                <th style="text-align:center; width: 60px">列表</th>
                                <th style="text-align:center;width: 80px">发帖人</th>
                                <th style="text-align:center;width: 120px">所在社区</th>
                                <th style="text-align:center;">内容</th>
                                <!-- <th>点赞数</th> -->
                                <!-- <th>状态</th> -->
                                <th style="text-align:center;width: 80px" ><a href="<?php echo U('list10');?>" class="btn btn-default" >评论数</a></th>
                                <!-- <th style="text-align:center;width: 60px">状态</th> -->

                                <th style="text-align:center;width: 120px">备注</th>
                                <th style="text-align:center;width: 80px"><a href="<?php echo U('list1');?>" class="btn btn-default" >点赞数</a></th>
                                <th style="text-align:center;width: 80px"><a href="<?php echo U('list2');?>" class="btn btn-default" >转发数</a></th>
                                
                                <th style="text-align:center;width: 130px">操作</th>

                               <!--  <th>性别</th>
                                <th>证件号</th> -->
                               <!--  <th style="width: 20%">操作</th> -->
                            </tr>
                            
                            <?php if(is_array($xinxianshi_list)): $i = 0; $__LIST__ = $xinxianshi_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xinxianshi): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($xinxianshi['id']); ?></td>
                                <td><?php echo ($xinxianshi['name']); ?></td>
                                <td><?php if(empty($xinxianshi['mingcheng'])): ?>体验小区<?php else: ?> 
                                <?php echo ($xinxianshi['mingcheng']); endif; ?></td>
                                <td><?php echo ($xinxianshi['neirong']); ?></td>
                                <!-- <td><?php echo ($xinxianshi['status']); ?></td> -->
                                <!-- <td><?php echo ($xinxianshi['dianzanshu']); ?></td> -->
    
                                <td><a href="<?php echo U('pingluncheck', ['xinxianshi_id'=>$xinxianshi['id']]);?>" class="btn btn-default" style="width:70px" title="查看评论"><?php echo ($xinxianshi['pinglunshu']); ?></a></td>
                                <!-- <td><?php echo ($xinxianshi['xianshi']=='1'?'启用':'禁用'); ?></td> -->
                                
                                 <td><?php echo ($xinxianshi['beizhu']); ?></td>
                                 <td><?php echo ($xinxianshi['dianzanshu']); ?></td>
                                <td><?php echo ($xinxianshi['zhuanfashu']); ?></td>
                                <td >
                                     <?php if($xinxianshi['xianshi']== 1): ?><input type="button" onclick="add(<?php echo ($xinxianshi['id']); ?>)" value="禁用"><?php else: ?> 已禁用<?php endif; ?>                                   
                                    
                                    <a href="<?php echo U('bianji1', ['xinxianshi_id'=>$xinxianshi['id']]);?>" class="btn btn-default"  title="编辑">编辑</a>
                                    <!-- <a href="<?php echo U('top', ['xinxianshi_id'=>$xinxianshi['id']]);?>" class="btn btn-default"  style="float: right">置顶</a> -->
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

<style>
.tcbg{  display:none;  position:fixed;  top: 0%;  left: 0%;  width: 100%;  height: 100%;  background-color:#000;   -moz-opacity: 0.5;  opacity:.50;  filter: alpha(opacity=50); z-index:5}
.tcdiv{ display:none;  position:fixed;  top:200px; right:350px; margin:auto; text-align:left;   width: 100%; max-width:300px;  height: 100px;  background-color:#ffffff;  z-index:6; padding:10px;}

.int{
    width:100%;
    }
 #we{
    float:right;
    margin-top:20px;
    }

</style>
<div class="tcbg" id="tcbg"></div>
<div id="tcdiv"  class="tcdiv">
<form action="<?php echo U('bianji');?>" method="get">
<input type="hidden" placeholder="备注信息" id="xid"  name="xinxianshi_id" > 
    <input type="text" class="int" placeholder="备注信息" id="beizhu"  name="beizhu" >
    <div id="we">
    <input type="submit" class="btn btn-primary" value="确认">
    &nbsp;<input type='button' class="btn btn-primary" onclick="removeElement()" value='取消'>
    </div>

 </form>

</div>

                 <a style="margin-left: 500px;" href="<?php echo U('Xinxianshi/list');?>" class="btn btn-primary">返&nbsp;回</a>
                
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