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
    <link href="/lebang18/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="/lebang18/Public/Admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/lebang18/Public/Admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/lebang18/Public/Admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    
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
 $url = CONTROLLER_NAME.'/'.ACTION_NAME; ?>
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
             <li class="treeview <?php if($url == "Order/list" OR $url == "Order/nopay" OR $url == "Order/liushi" OR $url == "Order/edit" OR $url == "Order/cancel"OR $url == "Order/fetch"): ?>active<?php endif; ?>">
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
            社区编辑
            <a href="<?php echo U('Shequ/list');?>" class="btn btn-default pull-right"><font color="black">社区列表</font></a>
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

    } 
   
</script>




        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form action="<?php echo U('Shequ/bianji',['shequ_id'=>$shequ['id']]);?>" method="post" enctype="multipart/form-data" onsubmit="return submits();">
                    <input type="hidden" name="id" value="<?=$shequ['id']?>">
                        <!-- <div class="box-header">
                            <h3 class="box-title"></h3>
                            <a href="<?php echo U('list');?>" class="btn btn-default pull-right">社区列表</a>
                        </div> --><!-- /.box-header -->

                        <div class="box-body">
                            <!-- <div class="form-group">
                                <label for="inputCategoryId">社区分类</label>
                                <select name="category_id" id="inputCategoryId" class="form-control">
                                
                                    <option value="0">--分类名称--</option>
                                    <?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><option value="<?php echo ($category['category_id']); ?>"><?php echo str_repeat('----', $category['deep']); echo ($category['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div> -->
                           <!--  <div class="form-group">
                                <label for="inputSubject"></label>
                                <td><img src="http://www.qinlinlebang.com/photo/avatar/<?php echo ((isset($user['avatar']) && ($user['avatar'] !== ""))?($user['avatar']):"avatar.png"); ?>" height="120px;" id="touxiang" /></td>
                            </div> -->
                            <!-- <td><img src="http://www.qinlinlebang.com/photo/avatar/<?php echo ((isset($user['avatar']) && ($user['avatar'] !== ""))?($user['avatar']):"avatar.png"); ?>" height="120px;" id="touxiang" /></td> -->
                            <!-- <div class="form-group">
                            <p></p>
                                <label for="inputSubject">姓&nbsp;&nbsp;名</label>
                                <input value="<?php echo ($user['name']); ?>" type="text" name="name" id="inputname"  maxlength="20"  /><br />
                            </div> -->
                            <div class="form-group">
                                <label style="width: 30%;" for="inputCover">&nbsp;社区名:</label>
                                <input id="keyword" value="<?php echo ($shequ['mingcheng']); ?>" style=" margin-left:-277px; height:33px; width:500px;" type="text" name="mingcheng" autocomplete="off"/><br />
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">社区照片:</label>

                                <img style="margin-left: 5px;" src="/lebang18/photo/shequ/s_<?php echo ((isset($shequ['zhaopian']) && ($shequ['zhaopian'] !== ""))?($shequ['zhaopian']):"shequ.png"); ?>"/>
                               </br><span style="margin-left: 75px;font-size:15px;color:red">更改封面:</span><input style="margin-left: 137px;margin-top: -21px;" type="file" name="zhaopian" id="zhaopian"value = "<?php echo ($shequ['zhaopian']); ?>" >
                                <input type="hidden" name="zhaopian" value = "<?php echo ($shequ['zhaopian']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputbirthday">社区坐标:</label>
                                <input id="zuobiao" value="<?php echo ($shequ['zuobiao']); ?>" style="height:33px; width:500px; margin-left:5px;" readonly="true" type="text" name="zuobiao" >
                            </div>
                            <div class="form-group">
                                <label for="inputSubject">社区详情:</label>
                                <input id="weizhi" value="<?php echo ($shequ['weizhi']); ?>" style="height:33px; width:500px;margin-left:5px;"  type="text" name="weizhi" /><br />
                            </div>

                             <div class="form-group">
                                <label for="inputSubject">是否启用:</label>
                                <select   name="xianshi" style=" margin-left:5px; height:33px; width:500px;">
                                      <option  name ="xianshi" value="1" <?php if($shequ["xianshi"] == 1): ?>selected<?php endif; ?> >是</option>
                                      <option  name="xianshi" value="0" <?php if($shequ["xianshi"] == 0): ?>selected<?php endif; ?> >否</option>
                                </select>
                            </div>

                            <!--  <div class="form-group">
                                <label for="inputSubject">所在地区:</label>
                                <input id="quyu" value="<?php echo ($shequ['quyu']); ?>" style="height:33px; width:500px;margin-left:5px;"  type="text" name="quyu" /><br />
                            </div> -->
<script>

function delAll(names){
  document.getElementById(names).options.length = 0;
}

function addOne(names,values,sid){
  var select = document.getElementById(names);
  select.options[select.length] = new Option(values,sid);
}

function gzsjdz(id,names){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
  if(this.readyState == 4){ //Ajax 请求
      var result = this.responseText;
      var res;
      if( result.indexOf('<') >= 0){
        result = result.split('<');
        res = eval(result[0]);
      }else{
        res = eval(result[0]);
      }
      
      delAll(names);
      for (var i = 0; i <= res.length - 1; i++) {
        // alert(res[i].mingcheng);
        addOne(names,res[i].mingcheng,res[i].id);
      }
      gzsjcity(res[0].id,'shjiarea');
      // if(names == 'shjicity'){
      //   gzsjdz(res[0].id,'shjiarea');
      //   gzsjdz(res[0].id,'shjishequ');
      // }
    }
  }
  xhr.open('get',"<?php echo U('shequ/ajax');?>?id="+id,true); //true
  xhr.send(null);

   // var xmlhttp;
   // var bs="sjdz";
   //    if (window.XMLHttpRequest)
   //      
   //      else
   //        
   //        //处理返回结果
   //      xmlhttp.onreadystatechange=function()
   //        {
   //      if(xmlhttp.readyState==4 && xmlhttp.status==200)
   //        {
   //          alert(xmlhttp.responseText);
   //          // document.getElementById('shjdizhi').innerHTML=xmlhttp.responseText;
   //          // var x=document.getElementById('shjdizhi').value;
   //          // document.getElementById('new_location').value=x;
   //          // document.getElementById('new_locations').value=x;
   //        }
   //      }
   //    //发送请求
   //    xmlhttp.open("GET",<?php echo U('admin/shequ/bianji');?>"?id="+id+"&bs="+bs,true);
   //    xmlhttp.send(); 
}

function gzsjcity(id,names){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
  if(this.readyState == 4){ //Ajax 请求
      var result = this.responseText;
      var res;
      if( result.indexOf('<') >= 0){
        result = result.split('<');
        res = eval(result[0]);
      }else{
        res = eval(result[0]);
      }
      delAll(names);
      for (var i = 0; i <= res.length - 1; i++) {
        addOne(names,res[i].mingcheng,res[i].id);
      }
      gzsjarea(res[0].id,'shjishequ');
    }
  }
  xhr.open('get',"<?php echo U('shequ/ajax');?>?id="+id,true); //true
  xhr.send(null);
}

function gzsjarea(id,names){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
  if(this.readyState == 4){ //Ajax 请求
      var result = this.responseText;
      var res;
      if( result.indexOf('<') >= 0){
        result = result.split('<');
        res = eval(result[0]);
      }else{
        res = eval(result[0]);
      }
      // delAll(names);
      delAll2();
      for (var i = 0; i <= res.length - 1; i++) {
        // addOne(names,res[i].mingcheng,res[i].id);
        addOne2(res[i].id,res[i].mingcheng);
      }
    }
  }
  xhr.open('get',"<?php echo U('shequ/ajax');?>?id="+id,true); //true
  xhr.send(null);
}
function delAll2(){
  // document.getElementById(names).options.length = 0;
  $('#shjishequ').empty();
}

function addOne2(id,values){
  // names,values,sid
  // var select = document.getElementById(names);
  // select.options[select.length] = new Option(values,sid);
  var shjishequ = document.getElementById('shjishequ');
  checkbox = document.createElement('input');
  checkbox.setAttribute('type','checkbox');
  checkbox.setAttribute('name','quyu[]');
  checkbox.setAttribute('value',id);
  shjishequ.appendChild(checkbox);
  shjishequ.appendChild(document.createTextNode(values+' '));
}

</script>
                          <div class="form-group">
                          <label for="inputSubject">所在地区:</label>
                          
                        <select id="shjidizhi" onChange="gzsjdz(this.options[this.options.selectedIndex].value,'shjicity');" class="xiala_2" name="pro">
                        <option class="option">请选择</option>
                        <?php
 $sjsql="SELECT * FROM `lb_area` WHERE sid= 1"; $sjreslut=M('area')->where('sid=1')->select(); foreach($sjreslut as $sjrow){ ?>
                             <option id="<?=$sjrow['sid']?>" value="<?=$sjrow['id']?>" ><?=$sjrow['mingcheng']?></option>
                        <?php
 } ?>
                        </select>

                        <select id="shjicity" onChange="gzsjcity(this.options[this.options.selectedIndex].value,'shjiarea');" class="xiala_2" name="city">
                        <option class="option">请选择</option>
                        </select>
                        
                        <select id="shjiarea" onChange="gzsjarea(this.options[this.options.selectedIndex].value,'shjishequ');" class="xiala_2" name="area">
                        <option class="option">请选择</option>
                        </select>
                        
                     <!--  <select id="shjishequ" onChange="gzsjshequ(this.options[this.options.selectedIndex].value);"  multiple="true" list="schList" listKey="schld" listValue="schNm" name="quyu[]">
                                           <option class="option">请选择</option> 
                                           </select> -->
                          </div>
                           <div class="form-group">
                                                 <label for="inputSubject" style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                         
                         <div id="shjishequ" name="quyu[]">
                           
                         </div>
                                                 </div> 

                            <div class="form-group">
                              <button class="btn btn-primary" style="margin-left:75px; width:500px;height:33px;" type="submit" name="submit" onclick="return confirmAct();"  value="publish">保存</button>
                            </div>
                        </div><!-- /.box-body --> 
                     
                           <!--  <a href="<?php echo U('edit', ['user_id'=>$user['id']]);?>" class="btn btn-default" title="编辑"><span class="fa fa-edit"></span> 编辑</a> -->
                            
                       <!-- /.box-footer -->
                    </form>


<script>
//

</script>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
<div  style="float: right; width:1px;height:1px;margin:-500px 110px 0 0" id="mapContainer"></div>
                     <div id="tip" style="margin:150px 0 0 600px">
                    <!-- <input type="text" id="keyword" name="keyword" value="请输入关键字：(选定后搜索)" onfocus='this.value=""'/> -->
                    <tr><td class="column2">
                    <!-- <label>左击获取经纬度：</label> --></td>
                    <td class="column2">
                    <input type="hidden" readonly="true" id="lnglat">
                     </td>
                    
                    </tr>

                    </div>
                     <div style="width:300px;height:200px;margin:30px 0 0 40px">
                        <script type="text/javascript">
                            var windowsArr = [];
                            var marker = [];
                            var mapObj = new AMap.Map("mapContainer", {
                                    resizeEnable: true,
                                    center: [116.397428, 39.90923],//地图中心点
                                    zoom: 13,//地图显示的缩放级别
                                    keyboardEnable: false
                            });
                            AMap.plugin(['AMap.Autocomplete','AMap.PlaceSearch'],function(){
                              var autoOptions = {
                                city: "北京", //城市，默认全国
                                input: "keyword"//使用联想输入的input的id
                              };
                              autocomplete= new AMap.Autocomplete(autoOptions);
                              var placeSearch = new AMap.PlaceSearch({
                                    city:'北京',
                                    map:mapObj
                              })
                              AMap.event.addListener(autocomplete, "select", function(e){
                                 //TODO 针对选中的poi实现自己的功能
                                 placeSearch.search(e.poi.name)
                                 console.log(e);
                                 document.getElementById("zuobiao").value = e.poi.location.lng + ',' + e.poi.location.lat;
                                 document.getElementById("weizhi").value = e.poi.district+e.poi.address;
                                 
                              });
                            });
                            

                        </script>
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