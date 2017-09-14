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
      <div id="profile-links"> Hello, <a href="#" title="Edit your profile"><?php echo (session('username')); ?></a>, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a><br />
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
    
   
			
    
     
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3>Content box</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Table</a></li>
            <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
              <!-- This is the target div. id must match the href of this div's tab -->
              <div class="notification attention png_bg"> 
              <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
              </a>
              <div> This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross. </div>
          </div>
          <a>你没有该权限！</a>
        </div>
        <!-- End #tab1 --> 
      </div>
      <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    
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