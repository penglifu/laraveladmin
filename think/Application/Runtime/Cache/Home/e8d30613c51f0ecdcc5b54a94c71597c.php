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
	
	
	
	
	
	
	
	
	
	
	
	
	
 

<title>收货地址</title>
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

						<div class="makesure_order_add">
							<p class="guide">
								<a>查看购物车</a><a class="inthis">填写和确认地址订单</a><a>提交订单成功</a>
							</p>

							<form method="post" action="">
								<div class="sure_add">
									<p class="address_text">确认收货地址</p>

                                  <?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="address_box">
										<div class="show">
											<input type="radio"  name="makesure_address" />
                                            <span><?php echo ($v["address"]); ?></span>
                                                                                                                                   （<span><?php echo ($v["name"]); ?></span> 收）
                                            <span><?php echo ($v["phone"]); ?></span>
										</div>

										<div class="hidden">
											<p>
												<span class="to_smwhere">寄送至</span>
												
                                                <input type="radio"	id="address<?php echo ($i); ?>"  name="makesure_address" value="<?php echo ($v["id"]); ?>" />
                                                <span><?php echo ($v["address"]); ?></span>
											</p>
											<p class="user_info">
											     
												（<span><?php echo ($v["name"]); ?></span> 收）
												 <span><?php echo ($v["phone"]); ?></span>
											</p>
											<p class="change_address">
												<a href="<?php echo U('MemberCenter/ModificationAddress',array('id'=>$v['id']));?>">修改本地址</a>
												<a class="delete">删除</a>
												<input type="hidden"  value="<?php echo ($v["id"]); ?>" class="de" />
											</p>
										</div>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>

									<p class="user_other_address">
										<a href="<?php echo U('MemberCenter/ModificationAddress');?>">使用其他地址</a>
										
									</p>
								</div>

								<div class="order_info">
									<p class="info_text">确认订单信息</p>
									<p class="title">
										<span class="pro_show">宝贝</span>
                                        <span class="price">单价</span>
                                        <span class="number">数量</span>
                                        <span class="subtotal">小计（元）</span>
									</p>
								<?php if(is_array($list)): foreach($list as $key=>$v): if(!empty($v['id'])): ?><div class="list_info_content">
										<div class="content_left">
											<div class="img">
											    <input type="hidden" name="color[]"  value="<?php echo ($v["colorvalue"]); ?>"/>
											    <input type="hidden" name="shopping_id[]"  value="<?php echo ($v["id"]); ?>"  class="id1"/>
											    <input type="hidden" name="product_id[]"  value="<?php echo ($v["product_id"]); ?>"/>
											    <input type="hidden" name="ordernum[]"  value="<?php echo ($v["ordernum"]); ?>"/>
												<img src="/think/<?php echo ($v['image']); ?>" />
											</div>
											<div class="info_text"><?php echo ($v["des"]); ?></div>
											
											<span class="price  pricenum"><?php echo ($v["promotion_price"]); ?></span> 
											
                                            <span class="numbers_override" id="makesure_page">
                                            <span ></span>
                                            <input value="<?php echo ($v["number"]); ?>" min="1" type="text" class="inputnum" name="number[]" readonly="readonly" />
                                            <span ></span>
                                            </span> 
                                            <span class="clear_float"></span>
										</div>

										<div class="content_mid">
                                            
											<a class="curr_price curr_price1"><?php echo ($v["price"]); ?></a> 
                                            <select name="chuxiao">
												<option>以省200元;卖家促销1</option>
												<option>以省200元;卖家促销2</option>
												<option>以省200元;卖家促销3</option>
											</select>
										</div>

										<div class="clear_float"></div>


									</div>
								  <?php else: ?>
								    <div class="list_info_content">
										<a class="curr_price"> 未购买商品！</a> 

									</div><?php endif; endforeach; endif; ?>
									<p class="givemess_toseller">
										给卖家留言：<input type="text" name="maseege" />
									</p>
									<p class="discount">
										店铺优惠： 
                                        <select class="s_discount" name="discount">
											<option>买满一百减1</option>
											<option>买满一百减2</option>
											<option>买满一百减3</option>
										</select>

									</p>


									<p class="discount">
										运送方式: 
                                        <select name="peishong">
											<option>普通配送&nbsp;快递 免邮1</option>
											<option>普通配送&nbsp; 快递 免邮2</option>
											<option>普通配送&nbsp; 快递 免邮3</option>
										</select>
									</p>
									<p class="total">
										店铺合计：<span>￥<a class="totals"><?php echo ($totals); ?></a>
										<input type="hidden" name="price" class="totals" value="<?php echo ($totals); ?>"/>
										</span>
									</p>
									<p class="submit">
										<input type="submit" value="提交订单" class="submit1" />
									</p>




								</div>


							</form>


						</div>




					</div>

					<div class="clear_float"></div>

				</div>

			</div>


		</div>


	</div>

		  <script>
		  $(".add").click(function(){
			var num=$(this).prev().val();
			  num++;
			//alert(num);
			var price=$(".pricenum").html();
			//alert(price)
			var pricenumber=num*price ;
			//alert(pricenumber);
			$(this).parent().parent().siblings(".content_mid").children(".curr_price").html(pricenumber);
			
			/* $(".totals").html(pricenumber);  */
			totals();  
			  
		  })
		  
		  
		   $(".reduce").click(function(){
			var num=$(this).next().val();
			  num--;
			//alert(num);
			var price=$(".pricenum").html();
			
			var pricenumber=num*price ;
			//alert(pricenumber);
			
			$(this).parent().parent().siblings(".content_mid").children(".curr_price").html(pricenumber);
			  
			totals(); 
		  })
		  
		   $("input[type='submit']").click(function(){
			 
			 var status = $("input[type='radio']").is(":checked");
			 if(!status){
				 alert("请选择地址");
				 return false;
			 }
			 
			 
		 }) 
		   /* function totals(){
			    	var count=0;
			    	var length = $("input[class='inputnum']").length;
			    
			    	//循环添加选中的价格累计 
			    	for(var i=0;i<length;i++){
			    		//i为下标 从零开始 ，长度从一开始  所以下标小于长度 
			    	   count += parseInt($(".curr_price1").eq(i).html());
			    	  //alert($(".curr_price1").eq(i).html())
			    	}
			    	//alert(count);
	    	      
	    	       $(".totals").html(count);
	    	       $(".totals").attr("value",count);
	    	      
		    	}
		  totals(); */
		 
		  
		  
		  
		   $(".delete").click(function(){
	    	   var id=$(this).siblings(".de").val();
	    	   var url="<?php echo U('MemberCenter/MakeSureTheOrderAndTheAddress');?>";
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
	       
	      $(".submit1").click(function(){ 
	    	  var id=$(".id1").val();
	    	 if(!id){
	    		 alert("请添加选择商品 ");
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