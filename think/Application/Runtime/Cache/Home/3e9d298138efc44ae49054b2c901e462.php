<?php if (!defined('THINK_PATH')) exit();?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<base href="/think/Application/Home/View/Public/resources/" />
<link rel="stylesheet" type="text/css" href="css/base_ducvy.css" />
<script type="text/javascript" src="js/jQuery.1.8.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<!-- 引入验证插件  -->
<script type="text/javascript"  src="/think/valite/js/Validform_v5.3.2_min.js"></script>
</head>

<body>

	<!--所有页面的头部-->
	<div class="header">
		<div class="headbox">
			<div class="logo">
				<a href="<?php echo U('Index/index');?>"><img src="images/ducvy_logo.jpg" /></a>
			</div>
			<div class="headbox_right">
				<div class="headbox_right_link">
					<p class="link_left">
					 <?php echo ($username); ?>: 欢迎来到本网站
					   <?php if(SESSION('username')): ?><a href="/think/index.php/Home/Login/loginout">退出登录</a> 
					   <?php else: ?>
                        <a href="/think/index.php/Home/Login/login"> 请登录</a> 
                        <a href="/think/index.php/Home/Regist/regist">免费注册</a><?php endif; ?>  
					</p>
					<p class="link_right">
						<a href="/think/index.php/Home/MemberCenter/MemberCenter" class="personcenter"> 个人中心</a> 
                        <a href="/think/index.php/Home/MemberCenter/ShoppingCart" class="mycookies"> 我的购物车（<span><?php echo ($shop); ?></span>）</a> 
                        <a href="<?php echo U('MemberCenter/Favorite');?>" class="collection"> 收藏夹</a>
					</p>
					<p class="clear_float"></p>
				</div>
				<div class="headbox_right_form">
					<form method="get" action="<?php echo U('Product/ProductCenter');?>">
						<input type="text" class="text" name="content" /> 
                        <input type="submit" class="submit" value="搜索" /> 
                        <span class="clear_float"></span>
					</form>
				</div>
				<div class="clear_float"></div>
			</div>
			<div class="clear_float"></div>

		</div>
	</div>



	<!--所有的顶导航  main_nav-->
	<div class="main_nav">
		<ul> 
             <?php if(is_array($arr)): foreach($arr as $key=>$v): if(CONTROLLER_NAME == $v["en"] ): ?><li class="main_nav_inthis"><a href="/think/index.php/Home/<?php echo ($v["url"]); ?>" class="inthis"><?php echo ($v["name"]); ?></a></li>
			    
			  <?php else: ?>
			   <li><a href="/think/index.php/Home/<?php echo ($v["url"]); ?>"><?php echo ($v["name"]); ?></a></li><?php endif; endforeach; endif; ?>
			<span class="clear_float"></span>
		</ul>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
 
<link href="/think/valite/css/demo.css" type="text/css" rel="stylesheet" />
<title>密码修改</title>
<!--页面内容-->
	<div class="content">
		<!--内容背景为第二种的时候 -->
		<div class="content_type_two">

			<!--为内容里面的内容-->
			<div class="content_body">
				<div class="background_orange"></div>
				<div class="background_coffee "></div>
				<!--侧导航-->
				<div class="kongzhi">
					<div class="sidebar">
						<div class="sidebar_top">


							<div class="sidebar_title">
								<p class="chinese">会员中心</p>
								<p class="english">Brand introduction</p>
							</div>


							<div class="sidebar_list ">

								<ul>
									<?php if(is_array($side)): foreach($side as $key=>$v): if($v["he"] == 0): if((ACTION_NAME) == $v['en']): ?><li class="list_inthis"><a href="/think/index.php/Home/<?php echo ($v["url"]); ?>" class="list_a_inthis"><?php echo ($v["name"]); ?></a></li>
									     
									          
									        
									    <?php else: ?>
									         <li><a href="/think/index.php/Home/<?php echo ($v["url"]); ?>"><?php echo ($v["name"]); ?></a></li><?php endif; endif; endforeach; endif; ?>
									<span class="clear_float"></span>
								</ul>

							</div>





						</div>





					</div>

					<!--内容的右侧-->
					<div class="content_body_right">
						<div class="right_title">
							<span class="titlename">修改密码</span> 
                            <span class="current_location">当前位置 >会员中心</span> 
                            <span class="clear_float"></span>
						</div>

						<div class="change_password">
							<form action="" method="post" class="message">
								<p class="hint">亲爱的，在此可以修改密码</p>
								<p>
									<span>当前密码：</span><input type="password"   ajaxurl="<?php echo U('MemberCenter/ChangePassword');?>" 	datatype="*5-12" nullmsg="密码不能为空" errormsg="长度大于等于5小于等于12" />
								</p>
								
								<p>
									<span>新密码：</span><input type="password" name="password" datatype="*5-12" nullmsg="密码不能为空" errormsg="长度大于等于5小于等于12" plugin="passwordStrength"  />
								</p>
								
								<p >
									<div class="passwordStrength" style="width:400px;margin-left:250px; margin-bottom:20px;">密码强度： <span>弱</span><span>中</span><span class="last">强</span></div>
								    <spanclass="clear_float"></span>
								</p>
								<p class="confirm_password">
									<span>确认新密码：</span><input type="password" datatype="*5-12" nullmsg="密码不能为空" errormsg="密码不一致" recheck="password"  />
								</p>
								<p>
									<span> 验证码：</span><input type="text"   datatype="*" nullmsg="验证码为空"  ajaxurl="<?php echo U('Public/vcode');?>"/>
								</p>
								<p>
									<a>请输入图中字符，不区分大小写</a>
								</p>
								<p class="code">
									<img src="<?php echo U('Public/vcode');?>"   class="code_image"/><a class="code_image">看不清，换一张</a>
								</p>
								<p class="submit">
									<input type="submit" value="确   定" />
								</p>
							</form>
						</div>




					</div>

					<div class="clear_float"></div>


				</div>
			</div>


		</div>


	</div>
	
<script type="text/javascript" src="/think/valite/plugin/passwordStrength/passwordStrength-min.js"></script>
	
    <script>
	$(".message").Validform({
		      tiptype:3,
		      showAllError:true,
		      usePlugin:{
					passwordstrength:{
						minLen:5,
						maxLen:12
					}
				}
		      
		});	
	
	/* 切换验证码 */
	var num =1;
	  $(".code_image").click(function(){
		 
		  	var url=$(this).attr("src");
		  	 
		  	
		  	//更改超链接地址的属性：
		  	//alert(url);
		  	$(this).attr("src","<?php echo U('Public/vcode');?>?num='"+num+"'");//变量不能在双引号中使用。
		  	$(".code_image").attr("src","<?php echo U('Public/vcode');?>?num='"+num+"'");
		  //然后让数字自增：
		  	num++;
		   
		  })
	
	</script>




	<!--所有页面的底部-->
	<div class="footer">
		<div class="footer_box">

			<p class="first">增值电信业务经营许可证：浙B2-20110446
				网络文化经营许可证：浙网文[2015]0295-065号 互联网医疗保健信息服务 审核同意书 浙卫网审【2014】6号</p>
			<p>互联网药品信息服务资质证书编号：浙-（经营性）-2012-0005</p>
			<p>© 2003-2015 TMALL.COM 版权所有</p>

		</div>
	</div>





</body>

</html>