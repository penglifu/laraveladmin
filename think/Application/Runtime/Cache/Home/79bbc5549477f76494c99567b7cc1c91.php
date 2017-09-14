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
	
	
	
	
	
	
	
	
	
	
	
	
	
 

<title>购物车</title>
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

						<div class="purchase_records">
							<p class="guide">
								<a class="inthis">查看购物车</a><a>填写和确认地址订单</a><a>提交订单成功</a>
							</p>


							<!--定单列表详情-->
							<div class="order_list">
								<p class="title">
									<span class="pro_show">宝贝</span><span class="price">单价（元）</span><span
										class="number">数量</span><span class="operation">商品操作</span><span
										class="trading_status">交易状态</span>
								</p>

								<form method="get" action="<?php echo U('MemberCenter/MakeSureTheOrderAndTheAddress');?>">

									<!--一个购物记录的模型-->


									<div class="list_show" id="list_show_content">
										



								   <?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="list_info">
											<p class="list_info_title">
												<input type="checkbox" name="checkbox[]" class="box"  value="<?php echo ($v["id"]); ?>" /><span class="date"><?php echo ($v["time"]); ?></span><span
												class="order_number">订单号：<?php echo ($v["ordernum"]); ?></span>
											</p>
											<div class="list_info_content">
												<div class="content_left">
													<div class="img">
													  
														<img src="/think/<?php echo ($v["images"]); ?>" />
													  
													</div>
													<div class="info_text">
														<a href="<?php echo U('Product/ProductCenterDetails',array('id'=>$v['product_id']));?>"><?php echo ($v["des"]); ?> </a></div>
													<span class="price"><?php echo ($v["promotion_price"]); ?></span>
													<span class="numbers_override">
													<span ></span>
													<input value="<?php echo ($v["number"]); ?>" min="1" type="text" class="min"   readonly="readonly" />
													<span ></span></span>
												</div>
												<div class="content_mid">
													<a class="ori_price"><?php echo ($v["price"]); ?></a>
												    <a class="curr_price"><?php echo ($v["total_value"]); ?></a>
												    
												    
													<a class="promotion" >卖家促销</a>
												</div>
												<div class="content_right">
													<a class="add_favorite  favoriteone">移入收藏夹</a> <a class="delete de" href="javascript:">删除</a>
                                                    <input type="hidden" class="hidden" value="<?php echo ($v["id"]); ?>"   />
                                                    
												</div>
												<div class="clear_float"></div>
											</div>
										</div><?php endforeach; endif; ?>

                                </div>

									<!--底部分页-->
									<div class="paging">
                                          <?php echo ($page); ?>
										<!-- <a href="" class="up_down_page">上一页</a> <a href="" 	class="up_down_page"> 下一页 </a> -->

									</div>
									
									<div class="accounts_box">
										 <input type="checkbox" id="all" />
										 <span>全选</span>
										 <span class="alldelete">删除</span>
										 <span class="favorite">移入收藏夹</span>
										 <span class="nub">已选商品<a>0</a>件</span> 
										 <span class="count">合计（不含运费）<a>￥00.0</a>
										 <input type="hidden" value="" name="price"  />
										 </span> 
										 
										 <input	value="结算" type="submit" />
									</div>



								</form>



							</div>







						</div>




					</div>

					<div class="clear_float"></div>



				</div>
			</div>


		</div>


	</div>
	
	
	
	

	
			     <script type="text/javascript">
				 $(function(){
			      function coun(){
			    	var count=0;
			    	var curr = $(".list_info_title input:checked");//获取当前input默认 
			    	var length = $(".list_info_title input:checked").length;
			    	//循环添加选中的价格累计 
			    	for(i=0;i<length;i++){
				    	count += parseInt(curr.eq(i).parent().siblings(".list_info_content").children(".content_mid").children(".curr_price").html());
				    	
				    	}
			    	//alert(count);
	    	      
	    	       $(".count").children().html(count);
	    	       $(".count").children().attr("value",count);
	    	       
	    	       var length = $(".list_info_title input:checked").length;
			    	//alert(length);
			    	$(".nub").children().html(length);
		    	}
			    
			      
			     
			     $(".add").click(function(){
						var num=$(this).prev().val();
						  num++;
						//alert(num);
						$(this).prev().attr("value",num);
						var price=$(this).parent().prev().html();
						//alert(price)
						var pricenumber=num*price ;
						//alert(pricenumber);
						$(this).parent().parent().siblings(".content_mid").children(".curr_price").html(pricenumber);
						$(this).parent().parent().siblings(".content_mid").children(".curr_price").attr("value",pricenumber);
						/* $(".totals").html(pricenumber);  */
						var status = $(this).parent().parent().parent().siblings(".list_info_title").children(".box").is(":checked"); 
						 //alert(status);
						 if(status){
							 
							 coun(); 
						 }
						
						  
					  })
			     
			     $(".reduce").click(function(){
						var num=$(this).next().val();
						  num--;
						//alert(num);
						$(this).next().attr("value",num);
						var price=$(this).parent().prev().html();
						//alert(price)
						var pricenumber=num*price ;
						//alert(pricenumber);
						$(this).parent().parent().siblings(".content_mid").children(".curr_price").html(pricenumber);
						$(this).parent().parent().siblings(".content_mid").children(".curr_price").attr("value",pricenumber);
						/* $(".totals").html(pricenumber);  */
						var status = $(this).parent().parent().parent().siblings(".list_info_title").children(".box").is(":checked"); 
						 //alert(status);
						 if(status){
							 
							 coun(); 
						 } 
						  
					  })
			     
					  
			    $("input[type='checkbox']").click(function(){
			    	
			    	 coun();
			      
			    })
			    
			    
			    
			    $("#all").click(function(){
			    	
			    	 coun();
		    		
			    })
			    
			    
			      coun();
				 })
			    
			    
			   $(".de").click(function(){
				 var id=$(this).siblings(".hidden").val();
				 
				  var url="<?php echo U('MemberCenter/ShoppingCart');?>";
				  //alert(url); 
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
			   
			   
			   //删除选中所有 
		 $(".alldelete").click(function(){
			    	 //获取input选中个数 
			   var length = $(".list_info_title input:checked").length;	 
			    	 //alert(length); 
			    var id1="";
			    for(i=0;i<length;i++){
				  id1+=$(".hidden").eq(i).val()+",";
			    } 
			    var id=id1.substr(0,id1.length-1); 
			    //alert(id);
				   var url="<?php echo U('MemberCenter/ShoppingCart');?>";
				  //alert(url); 
				   $.ajax({
					   //传参类型：input框一般为post
			              type:"post",
			              url:url,//访问页面的超链接地址
			              data:{id:id},//传参的数据，验证码
			              success:function(msg){
			            	//alert(msg);
			            	  if(msg==0){
			            	    alert("删除成功！ ");  
			            	  }else {
			            	    alert("删除失败！ ");    
			            		  
			            	  }
					   
			              }
					   
				   }) 
				     
				   
				   
			   }) 
			   
			   
			   //收藏夹 
			  $(".favorite").click(function(){
				
				  //alert(1);
				  	 //获取input选中个数 
				   var length = $(".list_info_title input:checked").length;
				  	 if(length>0){
				    	 //alert(length); 
				    var id1="";
				    for(i=0;i<length;i++){
					  id1+=$(".hidden").eq(i).val()+",";
				    } 
				    var id=id1.substr(0,id1.length-1); 
				    
				    var color1="";
				    for(i=0;i<length;i++){
				    	color1+=$(".color").eq(i).val()+",";
				    } 
				    var color=color1.substr(0,color1.length-1); 
				    
				    
				    //alert(id);
					   var url="<?php echo U('MemberCenter/Favorite');?>";
					  //alert(url); 
					   $.ajax({
						   //传参类型：input框一般为post
				              type:"post",
				              url:url,//访问页面的超链接地址
				              data:{id:id,color:color},//传参的数据，验证码
				              success:function(msg){
				            	//alert(msg);
				            	
				            if(msg==3){
				            	alert("收藏夹已满！  ");
				            }else{
				            	if(msg==2){
				            		alert("请勿重复添加！  ");
				            		
				            	}else{
				            	  if(msg==0){
				            	    alert("添加成功！ ");  
				            	  }else {
				            	    alert("添加失败 ！ ");    
				            		  
				            	  }
				            	  
				            	}  
						   
				              }
				            }	
					   }) 
					     
				  	 }else{
				  		alert("请添加商品 ！ ");
				  		return false ;
				  	 }
			  })
			   
			   
			 $(".favoriteone").click(function(){
				 //获取单条id 
				 var id=$(this).siblings(".hidden").val();
				 var color=$(this).siblings(".color").val();
				 //alert(color);
				 var url="<?php echo U('MemberCenter/Favorite');?>";
				 // alert(url); 
				  $.ajax({
					   //传参类型：input框一般为post
			              type:"post",
			              url:url,//访问页面的超链接地址
			              data:{id:id,color:color},//传参的数据，验证码
			              success:function(msg){
			            	//alert(msg);
	            	  if(msg==3){
			            	alert("收藏夹已满！  ");
			            }else{
			            	if(msg==2){
			            		alert("请勿重复添加！  ");
			            		
			            	}else{
			            	  if(msg==0){
			            	    alert("添加成功！ ");  
			            	  }else {
			            	    alert("添加失败 ！ ");    
			            		  
			            	  }
			            	  
			            	}  
					   
			              }
			           } 
				   }) 
				     
				  
				 
				 
			 })
			   
			$("input[type='submit']").click(function(){
				
				var length = $(".list_info_title input:checked").length;
				if(length<1){
					
					alert("请选择商品！")
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