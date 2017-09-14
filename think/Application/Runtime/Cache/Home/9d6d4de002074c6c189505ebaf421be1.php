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
	
	
	
	
	
	
	
	
	
	
	
	
	
 <title>产品详情</title>
	<!--banner_ad 横幅轮播图-->
	<div class="banner_ad">

		<div class="banner" id="banner">
			<div class="pages" data-scro="list">
				<ul>
					<?php if(is_array($list2)): foreach($list2 as $key=>$v): ?><li class="item" style="left: 0px;"><img src="/think/<?php echo ($v["images"]); ?>"></li><?php endforeach; endif; ?>
				</ul>
			</div>

			<div class="controler" data-scro="controler">
				<b class="down"></b> <b></b> <b></b>
			</div>
		</div>


	</div>


	<!--页面内容-->
	<div class="content">
		<!--内容背景为第一种的时候 -->
		<div class="content_type_one">

			<!--为内容里面的内容-->
			<div class="content_body">
				<div class="background_orange"></div>
				<div class="background_gray"></div>
				<div class="kongzhi">
					<!--侧导航-->
					<div class="sidebar">
						<div class="sidebar_top">


							<div class="sidebar_title">
								<p class="chinese">产品中心</p>
								<p class="english">Product Center</p>
							</div>


							<div class="sidebar_list">
								<ul>
									<?php if(is_array($category)): foreach($category as $key=>$v): if($categoryone == $v['id']): ?><li class="list_inthis"><a href="<?php echo U('Product/ProductCenter',array('id'=>$v['id']));?>" class="list_a_inthis"><?php echo ($v["name"]); ?></a></li>
									    <?php else: ?>
									    <li><a href="<?php echo U('Product/ProductCenter',array('id'=>$v['id']));?>"><?php echo ($v["name"]); ?></a></li><?php endif; endforeach; endif; ?>
									<span class="clear_float"></span>
								</ul>

							</div>

							<div class="sidebar_title sidebar_title_margin">
								<p class="chinese">联系我们</p>
								<p class="english">contact us</p>
							</div>



						</div>


						<div class="sidebar_bottom">
							<p class="onlinefirst">在线客服一：QQ<?php echo ($list1["servicea"]); ?></p>
							<p class="onlinesecend">在线客服二：QQ<?php echo ($list1["serviceb"]); ?></p>
							<p class="telphone">联系电话：<?php echo ($list1["phone"]); ?></p>
							<p class="email">邮箱：<?php echo ($list1["email"]); ?></p>
						</div>




					</div>

					<!--内容的右侧-->
					<div class="content_body_right">
						<div class="right_title">
							<span class="titlename">产品中心</span> 
                            <span class="current_location">当前位置>产品中心>购买产品</span> 
                            <span class="clear_float"></span>
						</div>
						<div class="product_center_details">
							<div class="product_center_details_top">
								<div class="cloth_show">
									<img src="/think/<?php echo ($list['arr2'][0][0]); ?>" />
									<p><?php echo ($list["des"]); ?></p>
								</div>
								<div class="cloth_info1">
									<p class="cloth_name"><?php echo ($list["title"]); ?></p>
									<div class="price">
										<p>
											价格 <span class="ori_price">￥<?php echo ($list["price"]); ?></span>
										</p>
										<p>
											<span class="pre_price_text">促销价</span><span class="pre_price">￥<?php echo ($list["promotion_price"]); ?></span>
										</p>
									</div>
									
									
									<p class="sales_comments">
									  <?php if(empty($sal)): ?>月销量 <span class="sales">0</span>
									  <?php else: ?>
									           月销量 <span class="sales"><?php echo ($sal); ?></span><?php endif; ?>
									</p>
									<!--- 尺码form表单   .border_red 加边框线-->
									<div class="size_form">
										<form method="post" action="" class="sub" >
											<p>
											    
												<a class="text">厚薄 </a>
												<!--<span status="on" class="thickness inthis">常规</span>-->
												<?php if(is_array($list['arr'])): foreach($list['arr'] as $k=>$v): ?><span status="on" class="thickness"><?php echo ($v[0]); ?></span>
											    <input  type="hidden" value="<?php echo ($v[1]); ?>" class="thick1" />
											    <input name="thicknessvalue" type="hidden" value="<?php echo ($k); ?>" /><?php endforeach; endif; ?>
											   
											</p>
											<p>
												<a class="text">尺码 </a>
												<?php if(is_array($list['arr1'])): foreach($list['arr1'] as $k=>$v): ?><input name="sizevalue" type="hidden" value="<?php echo ($k); ?>" />
												<span status="on" class="size"><?php echo ($v[0]); ?></span>
												<input  type="hidden" value="<?php echo ($v[1]); ?>" class="size1" /><?php endforeach; endif; ?>
											    
											</p>
											<p>
												<a class="text">颜色分类</a> 
												<!-- <span status="on" class="color">黑色</span> -->
												
												  <?php if(is_array($list['arr2'])): foreach($list['arr2'] as $k=>$v): ?><input name="colorvalue" type="hidden" vaule="<?php echo ($k); ?>" />
												   <span status="on" class="color"><img src="/think/<?php echo ($v[0]); ?>" /><span class="xiabiao"><?php echo ($k); ?></span></span>
											       <input  type="hidden" value="<?php echo ($v[1]); ?>" class="color1" /><?php endforeach; endif; ?>
											     
											</p>
											<p>
												<a class="text">数量</a><span status="on" class="quantity">
												<input type="number" name="number" class="input_quantity" id="count_number" /></span>
												<span>库存<a class="repertory"><?php echo ($numthick); ?></a></span>件 
											</p>


											<!--这里的两个跳转作为功能进行JS判断。当点击立即购买的时候跳转到某个action 判断。当点击加入购物车的时候跳转到某个action -->
											<p>
												<input type="submit" name="submit" value="立即购买" class="submit1" /> 
                                                <input type="submit" name="submit" value="加入购物车" class="submit2" /></span>
											</p>
										</form>

									</div>
								</div>
								<div class="clear_float"></div>
							</div>
							<!--产品中心的底部-->
							<div class="product_center_details_bottom">

								<div class="product_info2">
									<p>
										<span class="product_ref">产品参数：</span>
									</p>

									<p>
										<span>材质成分: <?php echo ($list["texture"]); ?></span> 
                                        <span>销售渠道类型:<?php echo ($list["distribution_channel"]); ?></span> 
                                        <span>风格: <?php echo ($list["style"]); ?></span> 
											
									</p>


									<p>
										<span>货号:<?php echo ($list["article_number"]); ?></span> 
                                        <span>服装版型:<?php echo ($list["model"]); ?></span> 
                                        <spanstyle="width:50px">厚薄:</span>
                                        <?php if(is_array($list['thickness'])): foreach($list['thickness'] as $key=>$v): ?><span style="width:50px"><?php echo ($v); ?></span><?php endforeach; endif; ?>
									</p>

									<p>
										<span>品牌:<?php echo ($list["trademark"]); ?></span> 
                                        <span>组合形式: <?php echo ($list["combining_form"]); ?></span> 
                                        <span>衣长:<?php echo ($list["clothes_length"]); ?></span>

									</p>


									<p>
										<span>袖长:<?php echo ($list["outside_sleeve"]); ?></span> 
                                        <span>领子:<?php echo ($list["collar"]); ?></span>
                                        <span>袖型:<?php echo ($list["outside_sleeve"]); ?></span>
									</p>


									<p>
										<span>衣门襟: <?php echo ($list["buckle"]); ?></span> 
                                        <span>图案: <?php echo ($list["pattern"]); ?></span> 
                                        <span>流行元素/工艺:<?php echo ($list["technology"]); ?></span>

									</p>


									<p>
										<span>适用年龄: <?php echo ($list["applicable_age"]); ?></span>
                                        <span>年份季节: <?php echo ($list["annual_seasons"]); ?></span> 
                                        <span>颜色分类: <?php echo ($list["color"]); ?></span>
									</p>

									<p>
										<span style="width:50px">尺码:</span>
										<?php if(is_array($list['size'])): foreach($list['size'] as $key=>$v): ?><span style="width:20px"><?php echo ($v); ?></span><?php endforeach; endif; ?>
									</p>


								</div>



							</div>


						</div>







					</div>

					<div class="clear_float"></div>



				</div>
			</div>


		</div>


	</div>

    <script type="text/javascript">
    $(".color").click(function(){
    	//alert(1);
     var url= $(this).children().attr("src");
      //alert(1);
      $(".cloth_show").children("img").attr("src",url);    	
    })
    
    $(".xiabiao").attr("style", "display:none");
    
    
   
   
    var totals_num = $(".repertory").html();
    
  var num= new Array(totals_num,totals_num,totals_num);

       
	    $(".thickness").click(function(){
	    	
	    	var num1=$(this).next(".thick1").val();
	    	
	    	
	    	 num[0] = num1;
	    	
	    	chang_num()
	    	
	    })
	    
	    
	     $(".size").click(function(){
	    	
	    	var num2=$(this).next(".size1").val();
	    	
	    	 num[1] = num2;
	    	 chang_num()
	    })
	    
	    $(".color").click(function(){
	    	
	    	var num3=$(this).next(".color1").val();
	    	
	    	 num[2] = num3;
	    	 chang_num()
	    })

	    
	function chang_num(){
	    	 
	    var min_num = Math.min.apply(null, num);//数组中取最小值 
	    $(".repertory").html(min_num);
	   
	    }
   
    
	 
	    $("input[name='submit']").click(function(){
	    	
	    	var numd =parseInt($(".repertory").html());
	    	var content1=parseInt($(".input_quantity").val());
	    	//alert(content1);
	    	if(content1>numd){
	    		
	    		alert("数量超出库存！")
	    		
	    		return false;
	    	}
	    	
	    	
	         
	    	var style=$(".thickness").attr("style");
	    	
	    	if(!style){
	    		//alert(1);
	    		alert("请选择厚薄！");
	    		
	    		return false;
	    		
	    	}
	    	
	       var style=$(".size").attr("style");
	    	
	    	if(!style){
	    		//alert(1);
	    		alert("请选择尺码！");
	    		
	    		return false;
	    		
	    	}
	    	
	       var style=$(".color").attr("style");
	    	
	    	if(!style){
	    		//alert(1);
	    		alert("请选择颜色！");
	    		
	    		return false;
	    		
	    	}
	    	
	    	var content=$("input[name='number']").val();
	    	if(content<1){
	              alert("请选择数量！");
	    		
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