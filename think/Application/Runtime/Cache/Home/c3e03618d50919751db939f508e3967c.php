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
	
	
	
	
	
	
	
	
	
	
	
	
	
 

<title>会员中心</title>

	<!--页面内容-->
	<div class="content">
		<!--内容背景为第二种的时候 -->
		<div class="content_type_two">

			<!--为内容里面的内容-->
			<div class="content_body">
				<div class="background_orange"></div>
				<div class="background_coffee "></div>
				<div class="kongzhi">
					<!--侧导航-->
					<div class="sidebar">
						<div class="sidebar_top">


							<div class="sidebar_title">
								<p class="chinese">会员中心</p>
								<p class="english">MemberCenter</p>
							</div>


							<div class="sidebar_list ">

								<ul>
									<!--  <li class="list_inthis"><a href="MemberCenter.html" class="list_a_inthis">个人信息</a></li>
									<li><a href="PersonalDateModifyView.html">个人资料修改/查看</a></li>
									<li><a href="ChangePassword.html">修改密码</a></li>
									<li><a href="PurchaseRecords.html">购买记录</a></li>
									<li><a href="ShoppingCart.html">购物车</a></li>
									<li><a href="OrderSubmitSuccess.html">确认订单</a></li>
									<li><a href="MakeSureTheOrderAndTheAddress.html">收货地址</a></li> -->
									
									
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
							<span class="titlename">个人信息</span> <span
								class="current_location">当前位置 >会员中心</span> <span
								class="clear_float"></span>
						</div>

						<div class="member_center">
							<div class="info_top">
								<div class="head_pic">
									<img src="/think/<?php echo ($images); ?>" />
								</div>
								<div class="info">
									<p>您好<?php echo ($username); ?></p>
									<p>
										<span>我的订单：</span><a><?php echo ($result); ?></a><span>收藏精品数：<a><?php echo ($result1); ?></a></span>
									</p>
									<p>
										<span>单日消费：</span>
                                        <a class="overmargin">￥</a>
                                        <a class="overmargin"><?php echo ($price); ?></a>
                                        <a class="overmargin">元</a>
									</p>
								</div>
								<div class="clear_float"></div>
							</div>

							<div class="like_bottom">
								<p class="like_title">猜你喜欢</p>
								<div class="like_content">
                                        
                                 <?php if(is_array($four)): foreach($four as $key=>$v): ?><div class="like_one">
										<a href="<?php echo U('Product/ProductCenterDetails',array('id'=>$v['id']));?>"> <img src="/think/<?php echo json_decode($v['images'])[0];?>" />
											<p><?php echo ($v["title"]); ?></p>
										</a>
										<p>
											<span>￥<?php echo ($v["promotion_price"]); ?></span><span class="price">店铺价：￥<span><?php echo ($v["price"]); ?></span></span>
										</p>
									</div><?php endforeach; endif; ?>   

								



									
									<div class="clear_float"></div>

								</div>
							</div>
						</div>




					</div>
					<div class="clear_float"></div>






				</div>

			</div>


		</div>


	</div>







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