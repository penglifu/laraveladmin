<?php if (!defined('THINK_PATH')) exit();?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- 引入验证插件  -->
<link href="/think/valite/css/demo.css" type="text/css" rel="stylesheet" />


<base href="/think/Application/Admin/View/Public/" />
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
<!-- jQuery Datepicker Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.datePicker.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.date.js"></script>


</head>
<body>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <div id="sidebar">
    <div id="sidebar-wrapper">
      <!-- Sidebar with logo and menu -->
      <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
      <!-- Logo (221px wide) -->
      <a href="http://www.865171.cn"><img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></a>
      <!-- Sidebar Profile links -->
      <div id="profile-links"> Hello, <a href="#" title="Edit your profile"><?php echo (session('names')); ?></a>, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a><br />
        <br />
        <a href="<?php echo U('Home/Index/index');?>" title="View the Site">View the Site</a> | <a href="<?php echo U('Login/loginout');?>" title="Sign Out">Sign Out</a> </div>
      <!-- <style>
       .he{display:none}
      </style> -->
      <ul id="main-nav">
        <?php if(is_array($all)): foreach($all as $key=>$v): if( $v["hidden"] == 0): if(CONTROLLER_NAME == $v['en'] ): ?><!-- 当前控制器 -->
           <li><a href="" class="nav-top-item current"> <?php echo ($v["name"]); ?></a>
        <?php else: ?>
           <li><a href="" class="nav-top-item"> <?php echo ($v["name"]); ?></a><?php endif; endif; ?>
          <ul>
            <?php if(is_array($v["zi"])): foreach($v["zi"] as $key=>$v1): if( $v1["hidden"] == 0): if((ACTION_NAME == $v1['en']) && (CONTROLLER_NAME == $v['en']) ): ?><!--当前控制器和操作  -->
	                <li><a class="current" href="/think/index.php/Admin/<?php echo ($v1["url"]); ?>"><?php echo ($v1["name"]); ?></a></li>
	              <?php else: ?>
	                 <li><a  href="/think/index.php/Admin/<?php echo ($v1["url"]); ?>"><?php echo ($v1["name"]); ?></a></li><?php endif; endif; endforeach; endif; ?>   
          </ul>
          
        </li><?php endforeach; endif; ?> 
      </ul>
      
      <!-- End #main-nav -->
      <div id="messages" style="display: none">
        <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
        <h3>3 Messages</h3>
        <p> <strong>17th May 2009</strong> by Admin<br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <p> <strong>2nd May 2009</strong> by Jane Doe<br />
          Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <p> <strong>25th April 2009</strong> by Admin<br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. <small><a href="#" class="remove-link" title="Remove message">Remove</a></small> </p>
        <form action="#" method="post">
          <h4>New Message</h4>
          <fieldset>
          <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
          </fieldset>
          <fieldset>
          <select name="dropdown" class="small-input">
            <option value="option1">Send to...</option>
            <option value="option2">Everyone</option>
            <option value="option3">Admin</option>
            <option value="option4">Jane Doe</option>
          </select>
          <input class="button" type="submit" value="Send" />
          </fieldset>
        </form>
      </div>
      <!-- End #messages -->
    </div>
  </div>
  <!-- End #sidebar -->
  <div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
      <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
        Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
    </noscript>
    <!-- Page Head -->
    <h2>Welcome www.865171.cn</h2>
    <p id="page-intro">What would you like to do?</p>
    <ul class="shortcut-buttons-set">
      <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/pencil_48.png" alt="icon" /><br />
        Write an Article </span></a></li>
      <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/paper_content_pencil_48.png" alt="icon" /><br />
        Create a New Page </span></a></li>
      <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/image_add_48.png" alt="icon" /><br />
        Upload an Image </span></a></li>
      <li><a class="shortcut-button" href="#"><span> <img src="resources/images/icons/clock_48.png" alt="icon" /><br />
        Add an Event </span></a></li>
      <li><a class="shortcut-button" href="#messages" rel="modal"><span> <img src="resources/images/icons/comment_48.png" alt="icon" /><br />
        Open Modal </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    
   
			
    
 <!--引入副编辑器对应文件  -->
<script type="text/javascript" charset="utf-8" src="/think/uedit/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/think/uedit/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/think/uedit/lang/zh-cn/zh-cn.js"></script>
<!--引入副编辑器对应文件  -->
    <title>产品新增</title>
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3>Content box</h3>
        <ul class="content-box-tabs">
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Forms</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">    
        <div class="tab-content default-tab" id="tab2">
          <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
            <p>
              <label>标题</label>
              <input class="text-input small-input a" type="text"  name="des" />
            </p>
            <p>
              <label>首页介绍</label>
              <input class="text-input small-input b" type="text"  name="introduce[]" />
              <input class="text-input small-input c" type="text"  name="introduce[]" />
              <input class="text-input small-input d" type="text"  name="introduce[]" />
            </p>   
           <p>
              <label>价格</label>
              <input class="text-input small-input e" type="text"  name="price" />
           </p> 
           <p>
              <label>促销价</label>
              <input class="text-input small-input f" type="text"  name="promotion_price" />
           </p>
           <label>厚度</label>   
           <p class="thickness">
              
              <input class="text-input  thick" type="checkbox"  value="常规"  name="thickness[]" />常规
              <input class="text-input  thick" type="checkbox"  value="超厚"  name="thickness[]" />超厚
           </p>
            <a>厚度库存</a>
           <ul class="thickrepertory" >
           
           
           </ul> 
           <label>尺码</label>
           <p class="size">

              <input class="text-input size1" type="checkbox"  value="S"  name="size[]" />S
              <input class="text-input size1" type="checkbox"  value="M"  name="size[]" />M
              <input class="text-input size1" type="checkbox"  value="L"  name="size[]" />L
              <input class="text-input size1" type="checkbox"  value="XL"  name="size[]" />XL
           </p>
            <a>尺码库存</a>
           <ul class="sizerepertory" >
           
           
           </ul>
            <p>
              <label>产品参数</label>
              <input class="text-input " type="text"  name="texture" />材质成分
              <input class="text-input " type="text"  name="article_number" />货号
              <input class="text-input " type="text"  name="trademark" />品牌
              <input class="text-input " type="text"  name="outside_sleeve" />袖长
              <input class="text-input " type="text"  name="buckle" />衣门襟
           </p> 
           <p>  
              <input class="text-input " type="text"  name="applicable_age" />适用年龄
              <input class="text-input " type="text"  name="distribution_channel" /> 销售渠道类型
              <input class="text-input " type="text"  name="model" /> 服装版型
              <input class="text-input " type="text"  name="combining_form" />  组合形式
              <input class="text-input " type="text"  name="collar" /> 领子
           </p>
            <p>  
              <input class="text-input " type="text"  name="pattern" />图案
              <input class="text-input " type="text"  name="annual_seasons" /> 年份季节
              <input class="text-input " type="text"  name="style" /> 风格
              <input class="text-input " type="text"  name="clothes_length" /> 衣长
              <input class="text-input " type="text"  name="sleeve_style" /> 袖型
           </p>
           <p>
              <input class="text-input " type="text"  name="technology" />流行元素/工艺
              <input class="text-input " type="text"  name="color" />颜色分类
           </p>
            <p>
              <label>分类</label>
              <select name="category">
                <?php if(is_array($category)): foreach($category as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
              </select>
            </p>
             <p>
              <label>产品简介</label>
              <textarea rows="2" cols="1"style="width:700px !important; resize: none;" name="title"></textarea>
            </p>
			<style>
			  
			  #main-content .images_list {padding-top:30px; overflow:hidden;}
			  #main-content .images_list li{list-style: none; margin-left:15px; padding:0; position: relative;width:100px; height:100px;float:left;}
			  #main-content .images_list li img{width:100px;height:100px; overflow:hidden;}
			  #main-content  .images_list li div{width:100px;height:100px;
			                          display: none;
									  position: absolute;
									  left: 0;top: 0;
									  background-color: rgba(100,140,120,0.4);
									 float: left;} 
			  #main-content  .images_list li div img{ width: 30px;
										   height: 30px; 
										   position: absolute;
										   top:-15px;right:-15px;
										  }
			 #main-content  .images_list li:hover div{display: block; cursor: pointer;} 
			</style>
            <p>
              <label>产品图片上传</label>
              <input type="file"   name="images[]" multiple="multiple" />
              <div>
                <ul class="images_list">
                
                
                </ul>
                <label>颜色库存</label>
                <a>点击图片生成库存输入框</a><br/>
                <ul class="repertory">
                
                
                </ul>
              </div>
            </p>
            <p>
              <input class="button" type="submit" value="Submit" />
            </p>
            </fieldset>
            <div class="clear"></div>
            <!-- End .clear -->
          </form>
        </div>
        <!-- End #tab2 -->
      </div>
      <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <script type="text/javascript">
    $("input[type='file']").change(function(){  
    	var j=0;/* 定义变量j表示图片下标 */
    	for (var i = 0; i < this.files.length; i++) {/* 循环图片下标 */
    	 var file = this.files[i]; /* 监听其中的一张图 */
    	   if (window.FileReader) {    
    	            var reader = new FileReader();    
    	            reader.readAsDataURL(file);    
    	            //监听文件读取结束后事件    
    	          reader.onloadend = function (e) {
    	                //e.target.result就是监听的图片地址
    	                var str="";
    	                
    	                str+="<li>";
    	                str+="<img src='"+e.target.result+"' />";
    	                str+="<input type='hidden' value='"+j+"' name='check_image[]' />"
    	                str+="<div><img class='delete' src='/think/fancy_close.png' /></div>";
    	                str+="</li>";
    	                
    	                $(".images_list").append(str);
    					j++;

    	            };   

    	       }
    	   }
    	})
    	
    	$(".delete").live("click",function(){
		
		  $(this).parent().parent().remove();
		  $(".repertory").children(":last").remove();
		
		
		})
		
		
	//生成库存 	
	$(".thick").click(function(){
		var status=$(this).is(":checked");
		var length=$(".thickness input:checked").length;
		var length1=$(".thickrepertory input").length;
		  if(status){
			  if(length1<length){
				   for(var i=0;i<length; i++){
					   var length2=$(".thickrepertory input").length;
					   if(length2<length){
					var str="";
					str+="<input class='text-input thickchang' type='text'   name='thickrepertory[]' />";
					
					$(".thickrepertory").append(str);
					   }
				   }
			  } 
		  }else{
			  
			 $(".thickrepertory").children(":last").remove();
		  }  
	})
	
	
	
	$(".size1").click(function(){
		var status=$(this).is(":checked");
		var length=$(".size input:checked").length;
		var length1=$(".sizerepertory input").length;
		  if(status){
			  if(length1<length){
		       for(var i=0; i<length; i++){
		    	      var length2=$(".sizerepertory input").length;
		    	        if(length2<length){
							var str="";
							str+="<input class='text-input se1' type='text'  name='sizerepertory[]' />";
							
							$(".sizerepertory").append(str);
		    	        }	
							
			       }
			       
				  } 
		  }else{
			  
			  $(".sizerepertory").children(":last").remove();
		  }
		
		  
	})
	
	
	
		
		
	$(".images_list li  ").live("click",function(){
		var length=$(".images_list li").length;
	    //alert(length);
	    var length1=$(".repertory input").length;
	    var j=0;
	   if(length1<length){
	    for(var i=0;i<length;i++){
			var str="";
			str+="<input class='text-input color' type='text'     name='colorrepertory[]' />";
	
		$(".repertory").append(str);
		
	    }
		
	  }
	})
	
	
	
	$(".button").live("click",function(){
		
		var text = $(".a").val();
		  if(!text){
			  alert("请输入标题！ ");
			  
			return false ;  
		  }
		  
		  
		  var text = $(".b").val();
		  if(!text){
			  alert("请输入首页介绍！ ");
			  
			return false ;  
		  }
		   
		  
		  var text = $(".c").val();
		  if(!text){
			  alert("请输入首页介绍！ ");
			  
			return false ;  
		  }
		   
		  var text = $(".d").val();
		  if(!text){
			  alert("请输入首页介绍！ ");
			  
			return false ;  
		  }
		  
	     
		  var text = $(".e").val();
		  if(!text){
			  alert("请输入价格！ ");
			  
			return false ;  
		  }
		  

		  var text = $(".f").val();
		  if(!text){
			  alert("请输入促销价！ ");
			  
			return false ;  
		  }
		  
		 var length=$("input[name='thickness[]']:checked").length;
		   if(length<1){
			   alert("请选择厚度！ ");
				  
				return false ;   
		   }
		   
		   var length=$(".thickrepertory input").length;
		    //alert(length);
		   for(var i=0; i<length;i++){
		   var text = $(".thickchang").eq(i).val();
			  if(!text){
				  alert("请输入厚度库存！");
				  
				return false ;  
			  }
		   }
		   
		  
	   var length=$("input[name='size[]']:checked").length;
	   if(length<1){
		   alert("请选择尺码！ ");
			  
			return false ;   
	   }
	  
	   
	   var length=$(".sizerepertory input").length;
	    //alert(length);
	   for(var i=0; i<length;i++){
	   var text = $(".se1").eq(i).val();
		  if(!text){
			  alert("请输入尺码库存！");
			  
			return false ;  
		  }
	   }
	   
	
		  
		  
		  var length=$(".images_list li").length;
		   if(length<1){
			   alert("请选择颜色图片！ ");
				  
				return false ;   
		   }	  
		  
		    var length=$(".repertory input").length;
		    //alert(length);
		   for(var i=0; i<length;i++){
		   var text = $(".color").eq(i).val();
			  if(!text){
				  alert("请输入颜色库存！");
				  
				return false ;  
			  }
		   }
	    
		   
		   
	})
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
		
		
		
		
		
		
		
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    
    </script>
<div class="content-box column-left">
      <div class="content-box-header">
        <h3>Content box left</h3>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab">
          <h4>Maecenas dignissim</h4>
          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo. </p>
        </div>
        <!-- End #tab3 -->
      </div>
      <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <div class="content-box column-right closed-box">
      <div class="content-box-header">
        <!-- Add the class "closed" to the Content box header to have it closed by default -->
        <h3>Content box right</h3>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab">
          <h4>This box is closed by default</h4>
          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo. </p>
        </div>
        <!-- End #tab3 -->
      </div>
      <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <div class="clear"></div>
    <!-- Start Notifications -->
    <div class="notification attention png_bg"> <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
      <div> Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. </div>
    </div>
    <div class="notification information png_bg"> <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
      <div> Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. </div>
    </div>
    <div class="notification success png_bg"> <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
      <div> Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. </div>
    </div>
    <div class="notification error png_bg"> <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
      <div> Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. </div>
    </div>
    <!-- End Notifications -->
    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2010 Your Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>