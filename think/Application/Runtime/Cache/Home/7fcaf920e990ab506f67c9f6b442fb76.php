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
	
	
	
	
	
	
	
	
	
	
	
	
	
 

<title>确认订单</title>


	<!--页面内容-->
	<div class="content">
		<!--内容背景为第二种的时候 -->
		<div class="content_type_two">

			<!--为内容里面的内容-->
			<div class="content_body">
				<div class="background_orange"></div>
				<div class="background_coffee background_coffee_override"></div>
				<div class="kongzhi">

					<!--侧导航-->
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
							<span class="titlename">订单提交成功</span> <span	class="current_location">当前位置 >会员中心</span> 
                            <span class="clear_float"></span>
						</div>

						<div class="order_submit_success">
							<p class="guide">
								<a>查看购物车</a><a>填写和确认地址订单</a><a class="inthis">提交订单成功</a>
							</p>
							<p class="hint">
								<span class="hint_img"></span><span class="success">订单提交成功</span>
                                <span class="pay">请尽快完成支付</span><span class="clear_float"></span>
							</p>
							<p class="price">
								<span>应付金额：</span>￥<a class="price1"><?php echo ($arra["price"]); ?></a>
							</p>
							<p class="address">
								收货信息： <span><?php echo ($arra["address"]); ?></span>
							</p>
							<p class="linkman">
								（<span><?php echo ($arra["name"]); ?></span> 收） <span><?php echo ($arra["phone"]); ?></span>
							</p>
							<p class="pay_way">
								<span>支付方式：</span> <a href=""></a><span class="clear_float"></span>
							</p>
							<p class="right_now_pay">
								<a href="<?php echo U('MemberCenter/PurchaseRecords',array('id'=>$arra['id'],'ordernum'=>$arra['ordernum']));?>"  class="submit">立即支付</a>
							</p>
						</div>




					</div>

					<div class="clear_float"></div>




				</div>
			</div>


		</div>


	</div>
    
    <script type="text/javascript">
     $(".submit").click(function(){
        
       var price = $(".price1").html();
    	 if(!price){
    		 
    		alert("请购买商品！") 
    		return false; 
    	 }
    	 
    	 
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