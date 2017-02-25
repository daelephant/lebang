<?php if (!defined('THINK_PATH')) exit();?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="/lebang11-29/Public/Admin/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script>
	/*function myFunction()
		{
			alert("请输入正确的密码");
		}*/
</script>
</head>
 
<body>
	<div class="main">
		<div class="user">
			<img src="/lebang11-29/Public/Admin/img/user.png" alt="">
		</div>
		<div class="login">
			<div class="inset">
				<!-----start-main---->
				<form action="<?php echo U('Login/login');?>" method="post" enctype="multipart/form-data">
			         <div>
						<span><label>用户名</label></span>
						<span><input type="text" class="textbox" name='username' id="active"></span>
					 </div>
					 <div>
						<span><label>密码</label></span>
					    <span><input type="password" name="password" class="password"></span>
					 </div>
					<div class="sign">
						<div class="submit" style = "float:right;">
						  <input type="submit"  value="登录" >
						</div>
						<!-- <span class="forget-pass">
							<a href="#">Forgot Password?</a>
						</span> -->
							<div class="clear"> </div>
					</div>
					</form>
				</div>
			</div>
		<!-----//end-main---->
		</div>
		
</body>
</html>