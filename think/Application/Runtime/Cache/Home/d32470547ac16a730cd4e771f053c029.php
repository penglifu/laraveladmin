<?php if (!defined('THINK_PATH')) exit();?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="/think/Application/Home/View/Public/resources/" />
<script type="text/javascript" src="js/jQuery.1.8.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" type="text/css" href="css/base_ducvy.css">
<!-- 引入验证插件  -->
<script type="text/javascript"  src="/think/valite/js/Validform_v5.3.2_min.js"></script>
	<title>用户注册</title>
</head>

<body>
	<div class="content">
		<div class="login_content">
			<div class="login_regist_background">
				<div class="regist_background"></div>
				<div class="form_regist">
					<div class="regist">
						<span class="newregist">新用户注册</span><span class="isvip">已经是会员？直接<a href="/think/index.php/Home/Login/login" class="login">登录</a></span><span class="clear_float"></span>
					</div>
					<form method="post" action="" class="message"> 
						<p class="formdata">
							<span>账号：</span><input class="uname" name="username" type="text" ajaxurl="/think/index.php/Home/Regist/regist" 	value="请输入手机号/会员名"  datatype="*3-14" nullmsg="用户名不能为空" errormsg="用户名长度为3-14位"  ></input>
						</p>
						<p class="formdata">
							<span>email：</span><input class="uname" name="email" type="text" ajaxurl="<?php echo U(Regist/regist);?>" 	value="请输入邮箱" datatype="e" nullmsg="email不能为空" errormsg="email格式错误"  ></input>
						</p>
						<p class="formdata">
							<span>密码：</span><input class="upassword" name="password"
								type="password"  datatype="*5-12" nullmsg="密码不能为空" errormsg="长度大于等于5小于等于12"></input>
						</p>
						<p class="formdata">
							<span>确认密码：</span><input class="upasswordagain" name="upassword"
								type="password" datatype="*5-12" nullmsg="密码不能为空" errormsg="密码不一致" recheck="password" ></input>
						</p>
						<p class="useragreement">
							<label  class="label" ><input class="useragreements" name="useragreement"
								type="checkbox"  value="1" datatype="*" nullmsg="请选择" > </input><span class="read">我已阅读并接受《用户服务协议》</span>
							</label> <span class="clear_float"></span>
						</p>
						<p>
							<input type="submit" class="submit" value="注册" />
						</p>
						
						<p class="clear_float"></p>
					</form>
				</div>

				<span class="copyright">Copyright 2008-2015 vip.com，All	Rights Reserved ICP证：粤 B2-20080329</span>
			</div>
		</div>
	</div>

</body>
	<script>
	$(".message").Validform({
		      tiptype:3,
		      showAllError:true,
		
		      
		});	
		
	
	</script>


</html>