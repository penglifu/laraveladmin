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
	
	
	
	
	
	
	
	
	
	
	
	
	
 

<title>购买记录</title>
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
							<span class="titlename">购买记录</span> <span
								class="current_location">当前位置 >会员中心</span> <span
								class="clear_float"></span>
						</div>

						<div class="purchase_records">

							<!--两个表单  一个订单搜索  一个订单删除-->
							
							<div class="order_search">
								<div class="head_pic">
									<img src="images/purchase_records.jpg" />
								</div>
								<div class="user_name">
									<p class="welcome_back_text">嗨~欢迎回来</p>
									<p class="name"><?php echo (session('username')); ?></p>
								</div>
                                <form method="get" action="">
								<div class="search_box">
									<input type="text" name="oder" placeholder="输入商品标题或订购号进行搜索" />
                                    <input type="submit" value="订单搜索" />
								</div>
								</form>
								<div style="clear: both;"></div>

							</div>

							<!--定单列表详情-->
							<div class="order_list">
								<p class="title">
									<span class="pro_show">宝贝</span><span class="price">单价（元）</span><span
										class="number">数量</span><span class="operation">商品操作</span><span
										class="trading_status">交易状态</span>
								</p>

								<form method="post" action="">

									<!--一个购物记录的模型-->
									
							   <?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="list_info">
										<p class="list_info_title">
											<input type="hidden" class="de" value="<?php echo ($v["id"]); ?>"/><span class="date"><?php echo ($v["time"]); ?></span>
                                            <span class="order_number">订单号：<?php echo ($v["ordernum"]); ?></span><a  class="delete" href="javascript:">删除</a>
										</p>
										<div class="list_info_content">
											<div class="content_left">
												<div class="img">
													<img src="/think/<?php echo ($v["images"]); ?>" />
												</div>
												<div class="info_text"><a href="<?php echo U('Product/ProductCenterDetails',array('id'=>$v['product_id']));?>"><?php echo ($v["des"]); ?></a></div>
												<span class="price">￥<?php echo ($v["promotion_price"]); ?></span> <span class="numbers"><?php echo ($v["number"]); ?></span>
												<span class="clear_float"></span>
											</div>

											<div class="content_mid">
												
												<a>支付状态</a>
												<?php if($v['zhihu']=='未支付'): ?><a href="<?php echo U('MemberCenter/OrderSubmitSuccess',array('id'=>$v['id'],'ordernum'=>$v['ordernum']));?>"><span><?php echo ($v["zhihu"]); ?></span></a>
												<?php else: ?>
												<a><span>已付款</span></a><?php endif; ?>
												<a>发货状态</a>
												<?php if($v['fahuo']=='未发货'): ?><a><span><?php echo ($v["fahuo"]); ?></span></a>
												<?php else: ?>
												<a><span>已发货</span></a><?php endif; ?>
												
											</div>
											<div class="content_right">
												 <a href="<?php echo U('MemberCenter/Orderdetail',array('id'=>$v['id']));?>">订单详情</a> 
												 <a>点击确认收货</a>
												 <a class="shouhuo">
												 <?php if($v['shouhuo']=='已收货'): ?><span class="huo"><?php echo ($v["shouhuo"]); ?></span>
												 <?php else: ?>
												 <span class="huo">确认收货</span><?php endif; ?>
												 <input type="hidden" class="shou" value="<?php echo ($v['id']); ?>"/></a>
												
												 
											</div>
											<div class="clear_float"></div>
										</div>
									</div><?php endforeach; endif; ?>
								
								</form>



							</div>




							<!--底部分页-->
							<div class="paging">
                                     
                                 <?php echo ($page); ?> 
								<!--  <a href="">上一页</a>
                                <a href="" class="digital"> 1 </a>
                                <a href="" class="digital"> 2 </a>
                                <a href="" class="digital"> 3 </a> 
                                <a	href="" class="digital"> 4 </a> <a href="" class="digital">	5 </a> 
                                <a href=""> 下一页 </a> 
                                <a href=""> 末页</a>  -->
                               
							</div>
                            

						</div>




					</div>

					<div class="clear_float"></div>




				</div>
			</div>


		</div>


	</div>

    <script>
       $(".delete").click(function(){
    	   var id=$(this).siblings(".de").val();
    	   var url="<?php echo U('MemberCenter/PurchaseRecords');?>";
    	   $.ajax({
			   //传参类型：input框一般为post
	              type:"post",
	              url:url,//访问页面的超链接地址
	              data:{id:id},//传参的数据，验证码
	              success:function(msg){
	            	
	            	  if(msg==0){
	            	    alert("删除成功！ ");  
	            	  }else {
	            	    alert("删除失败！ ");    
	            		  
	            	  }
			   
	              }
			   
		   }) 
    	   
    	   
    	   
    	   
       })
    
    
       
       $(".shouhuo").click(function(){
    	  
    	   var id=$(this).children(".shou").val();
    	   //alert(id);
    	   var url="<?php echo U('MemberCenter/PurchaseRecords');?>";
    	   var huo=$(this).children(".huo");
    	   var shou="已收货";
    	   $.ajax({
			   //传参类型：input框一般为post
	              type:"get",
	              url:url,//访问页面的超链接地址
	              data:{id:id},//传参的数据，验证码
	              success:function(msg){
	            	
	            	  if(msg==0){
	            	    $(huo).html(shou);
	            		  
	            		  
	            	  }else {
	            	    alert("已收货请勿重复点击！ ");    
	            		  
	            	  }
			   
	              }
			   
		   })
    	   
    	   
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