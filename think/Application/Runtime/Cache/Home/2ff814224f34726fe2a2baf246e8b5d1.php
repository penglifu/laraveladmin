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
	
	
	
	
	
	
	
	
	
	
	
	
	
 

<title>新闻详情</title>
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
								<p class="chinese">新闻中心</p>
								<p class="english">NEWS</p>
							</div>


							<div class="sidebar_list">

								<ul>
									
									<?php if(is_array($category)): foreach($category as $key=>$v): if($categoryone == $v['id']): ?><li class="list_inthis"><a href="<?php echo U('News/NewsCenter',array('id'=>$v['id']));?>" class="list_a_inthis"><?php echo ($v["name"]); ?></a></li>
									    <?php else: ?>
									    <li><a href="<?php echo U('News/NewsCenter',array('id'=>$v['id']));?>"><?php echo ($v["name"]); ?></a></li><?php endif; endforeach; endif; ?>
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
							<span class="titlename">新闻中心</span> <span
								class="current_location">当前位置>新闻中心>详情页</span> <span
								class="clear_float"></span>
						</div>
						
                    <?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="newscontent_details">
							<div class="details_title"><?php echo ($v["title"]); ?></div>
							<div class="details_info">
								<p class="info">作者：<?php echo ($v["author"]); ?> 时间：<?php echo ($v["time"]); ?>   内容来源：<?php echo ($v["content_source"]); ?>
									图片来源：<?php echo ($v["des_source"]); ?></p>
								<p class="guide">文章导读</p>
							</div>
							<div class="details_pick"><?php echo ($v["des"]); ?></div>
							<div class="details_img">
								<img src="/think/<?php echo ($v["images"]); ?>" />
							</div>
							<div class="details_text"><?php echo ($v["content"]); ?></div>
						</div><?php endforeach; endif; ?>




						<!--底部分页-->
						<div class="paging">
							<!-- <a href="">首页</a> 
                            <a href="">上一页</a> 
                            <a href="" class="digital">	1 </a> 
                            <a href="" class="digital"> 2 </a> 
                            <a href="" class="digital">3 </a> 
                            <a href="" class="digital"> 4 </a> 
                            <a href="" class="digital">	5 </a> 
                            <a href=""> 下一页 </a> <a href=""> 末页</a> -->
                            <?php echo ($page); ?>
						</div>


					</div>

					<div class="clear_float"></div>



				</div>
			</div>


		</div>


	</div>

   <script>
   
      var height = $(".kongzhi").height();
      //alert(height);
      if(height>1102){
      $(".content").height(height);
      }
     
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