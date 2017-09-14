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
	
	
	
	
	
	
	
	
	
	
	
	
	
 


<title>个人资料</title>

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
							<span class="titlename">个人资料修改/查看</span> <span
								class="current_location">当前位置 >会员中心</span> <span
								class="clear_float"></span>
						</div>

						<div class="personal_date_modify_view">
							<form action="" method="post" enctype="multipart/form-data" class="message">
								<p class="head_pic">
									<span>头 像：</span>
									<div style="border:1px solid #000;width:150px;height:150px;margin-left:150px;">
									<img alt="上传头像" src="/think/<?php echo ($nick["images"]); ?>" class="img" style="width:150px;height:150px;" >
									</div>
									<a style="margin-left:200px;">选择头像</a>
                                    <input type="file"   name="images"  />
								</p>
								<style>
								.divin{margin-left:50px;}
								.inpu{width:200px;height:30px;}
								
								</style>
								<div class="divin">
									<span>昵 称：</span><input class="inpu" name="username" value="<?php echo ($nick["username"]); ?>" datatype="*" nullmsg="昵 称不能为空" ajaxurl="<?php echo U('MemberCenter/PersonalDateModifyView',array('id'=>$nick['id']));?>" />
								</div>
								<div class="divin">
									<span>邮 箱：</span><input class="inpu" name="email" value="<?php echo ($nick["email"]); ?>" datatype="e" nullmsg="email不能为空" errormsg="email格式错误" ajaxurl="<?php echo U('MemberCenter/PersonalDateModifyView',array('id'=>$nick['id']));?>"/>
								</div>
								<div class="divin">
									<span>Q Q：</span><input class="inpu" name="qq" value="<?php echo ($nick["qq"]); ?>" datatype="n" nullmsg="qq不能为空"  ajaxurl="<?php echo U('MemberCenter/PersonalDateModifyView',array('id'=>$nick['id']));?>"/>
								</div >
								<div class="divin">
									<span>电话：</span><input class="inpu" name="phone" value="<?php echo ($nick["phone"]); ?>" datatype="m" nullmsg="电话不能为空" errormsg="号码长度为11位数" ajaxurl="<?php echo U('MemberCenter/PersonalDateModifyView',array('id'=>$nick['id']));?>" />
								</div>
								<div class="sex divin">
								
									<span>性 别：</span>
									<?php if($nick['sex'] == 1): ?><input name="sex" value="1" type="radio" checked="checked"/><a>男</a>
									    <input name="sex" value="2" type="radio" /><a>女</a>
									<?php else: ?>
									    <input name="sex" value="1" type="radio" /><a>男</a>
										<input name="sex" value="2" type="radio" checked="checked" /><a>女</a><?php endif; ?>
								</div>
								<p class="submit">
									<input type="submit" value="修改" />
								</p>
							</form>
						</div>




					</div>

					<div class="clear_float"></div>

				</div>
			</div>


		</div>


	</div>
    <script type="text/javascript">
    $("input[type='file']").change(function(){   
    	 var file = this.files[0]; //监听其中的一张图
    	   if (window.FileReader) {    
    	            var reader = new FileReader();    
    	            reader.readAsDataURL(file);    
    	            //监听文件读取结束后事件    
    	          reader.onloadend = function (e) {
    	            $(".img").attr("src",e.target.result);    //e.target.result就是监听的图片地址
    	            };   

    	       }
    	})
    	
     $(".message").Validform({
		  //alert(1);
		      tiptype:3,
		      showAllError:true,
		
		});	
    	
    	
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