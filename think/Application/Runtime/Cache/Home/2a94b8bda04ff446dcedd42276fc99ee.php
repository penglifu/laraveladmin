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
	
	
	
	
	
	
	
	
	
	
	
	
	
 <title>首页</title>
	<!--首页面-->
	<div class="indexcontent">
		
			<div class="link_cloth">
            	<div class="link_one link_one_margin">
                	<p></p>
                    <div class="link">
                    	<a href="<?php echo U('Product/ProductCenterDetails',array('id'=>$list7['id']));?>">  
                            <div><img src="/think/<?php echo ($list7['images'][0]); ?>" /></div>
                            <div class="text">
                                <span><?php echo ($one["name"]); ?></span>
                                <?php if(is_array($list7['introduce'])): foreach($list7['introduce'] as $key=>$v): ?><span><?php echo ($v); ?></span><?php endforeach; endif; ?>
                            </div>
                         </a> 
                    </div>
                </div>
                
                <div class="link_one" >
                	<p></p>
                    <div class="link">
                    	<a href="<?php echo U('Product/ProductCenterDetails',array('id'=>$list8['id']));?>">  
                            <div><img src="/think/<?php echo ($list8['images'][0]); ?>" /></div>
                            <div class="text">
                                <span><?php echo ($two["name"]); ?></span>
                                <?php if(is_array($list8['introduce'])): foreach($list8['introduce'] as $key=>$v): ?><span><?php echo ($v); ?></span><?php endforeach; endif; ?>
                            </div>
                         </a> 
                    </div>
                </div>
                
                <div class="link_one link_one_floatright">
                	<p></p>
                    <div class="link">
                         <a href="<?php echo U('Product/ProductCenterDetails',array('id'=>$list9['id']));?>">  
                            <div><img src="/think/<?php echo ($list9['images'][0]); ?>" /></div>
                            <div class="text">
                                <span><?php echo ($three["name"]); ?></span>
                                <?php if(is_array($list9['introduce'])): foreach($list9['introduce'] as $key=>$v): ?><span><?php echo ($v); ?></span><?php endforeach; endif; ?>
                            </div>
                         </a> 
                    </div>
                </div>
                
                <div class="clear_float"></div>
            
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