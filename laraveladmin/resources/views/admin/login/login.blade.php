<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Simpla Admin | Sign In by www.865171.cn</title>
    <link rel="stylesheet" href="valite/css/style.css" type="text/css" />
    <base href="{{asset('index.php')}}"/>
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
</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
    <div id="login-top">
        <h1>Simpla Admin</h1>
        <!-- Logo (221px width) -->
        <a href="http://www.865171.cn"><img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></a>
        @if(!empty(session('msg')))
          <div>{{session('msg')}}</div>
        @endif
    </div>
    <!-- End #logn-top -->

    <div id="login-content">
        <form action="" method="get" class="message" >
            {{csrf_field()}}
            <div class="notification information png_bg">
                <div> Just click "Sign In". No password needed. </div>
            </div>
            <p>
                <label>Username</label>

                <input class="text-input" type="text"  name="names" datatype="*3-14" nullmsg="用户名不能为空"  />

            </p>
            <div class="clear"></div>
            <p>
                <label>Password</label>
                <input class="text-input" type="password" name="password" datatype="*5-12" nullmsg="密码不能为空"  />

            </p>
            <div class="clear"></div>
            <p>
                <label>验证码</label>
                <input class="text-input" type="text" name="code"   datatype="*" nullmsg="验证码为空"  ajaxurl="{{url('admin/login/login')}}" />
            </p>
            <div class="clear"></div>
            <p>
                <a>请输入图中字符，不区分大小写</a>
            </p>
            <div class="clear"></div>
            <p class="code">
                <img src="{{url('admin/login/vcode')}}/+num"   class="code_image"/><a class="code_image">看不清，换一张</a>
            </p>
            <div class="clear"></div>
            <p id="remember-password"><input type="checkbox" value="1" name="remember" />Remember me </p>
            <div class="clear"></div>
            <p><input class="button" type="submit" value="Sign In" /></p>
            <p><a href="{{url('admin/login/getpassword')}}">忘记密码</a></p>
        </form>
    </div>
    <!-- End #login-content -->
</div>
<!-- End #login-wrapper -->
</body>
</html>
<script type="text/javascript" src="valite/js/jquery-1.9.1.min.js"></script>

<script type="text/javascript"  src="valite/js/Validform_v5.3.2_min.js"></script>

<script  type="text/javascript">
    /*加到$.ajax请求之前*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".message").Validform({
        tiptype:3,
        showAllError:true,

    });

    /* 切换验证码 */
    var num =1;
    $(".code_image").click(function(){

        var url=$(this).attr("src");


        //更改超链接地址的属性：
        //alert(url);
        $(this).attr("src","{{url('admin/login/vcode')}}/'"+num+"'");//变量不能在双引号中使用。
        $(".code_image").attr("src","{{url('admin/login/vcode')}}/'"+num+"'");
        //然后让数字自增：
        num++;

    })

</script>
