
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Simpla Admin | Sign In by www.865171.cn</title>
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
    </div>
    <!-- End #logn-top -->

    <div id="login-content">
        <form action="" method="post">
              {{csrf_field()}}
            <div class="notification information png_bg">
                <div> Just click "Sign In". No password needed. </div>
            </div>
            <p>
                <label>邮箱</label>
                <input class="text-input" type="text" name="email"  />
            </p>
            <div class="clear"></div>
            <div class="email_error red_error"></div>
            <p style="color:#ccc; font-weight:bold; background-color:#666; width:180px; he
         ight:30px; line-height:30px; text-align:center" class="getcode">点击获取.验证码</p>

            <div class="clear"></div>

        </form>
    </div>
    <!-- End #login-content -->
</div>
<!-- End #login-wrapper -->
</body>
</html>
<script type="text/javascript" src="valite/js/jquery-1.9.1.min.js"></script>
<script>
    var id;
    //邮件发送成功：插入验证码输入框  文字改变（文字上的时间每隔一秒-1）
    $(".getcode").click(function(){

        var email =$("input[name='email']").val(); //获取用户输入的邮箱
        if(email.length==0){
            $(".email_error").html("邮箱不能为空");
        }else{
            var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
            //js中正则表达式不能加单双引号
            var result =reg.test(email);
            var url="{{url('admin/login/sendemail')}}";
            if(result){
                if($("input[name='code']").length==0){ //如果不为0代表已经点击获取验证码
                    //请求发送邮件的php页面

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:"post",
                        url:url,
                        data:{email:email,_token:"{{csrf_token()}}"},
                        async:false, //代表同步传输
                        success:function(msg){
                            //alert(msg);

                            $(".email_error").html("");
                            //msg如果等于1
                            if(msg==1){

                                //插入验证码输入框
                                var str="<p>";
                                str+="<label>输入验证码</label>";
                                str+='<input class="text-input code1" type="text" name="code"  />';
                                str+="</p>";
                                str+='<div class="clear"></div><div class="code_error red_error"></div>';
                                $("form").append(str);

                                //文字改变：

                                id=setInterval(changeTime,1000);

                            }
                        }
                    })
                }
            }else{
                $(".email_error").html("邮箱格式错误");
            }

        }

    })

    var s=120;
    function changeTime(){
        var str="验证码发送成功，有效期为<span style='color:red'>"+s+"</span>s";
        if(s<=0){
            $(".getcode").html("您的验证码已经过期,请重新获取验证码");
            clearInterval(id);

        }else{
            $(".getcode").html(str);
            s--;
        }
    }

    //给验证码输入框绑定失去焦点
    $(document).on("blur",".code1",function(){
        var code = $(this).val();
        var url="{{url('admin/login/getpassword')}}";

        $.post(url,{code:code},function(msg){

            if(msg==1){
                $(".code_error").html("");
                clearInterval(id);
                $(".getcode").html("您验证码验证成功");
                var str="<p>";
                str+="<label>密码：</label>";
                str+='<input class="text-input " type="password" name="password"  />';
                str+="</p>";
                str+='<div class="clear"></div><p>';
                str+="<label>确认密码：</label>";
                str+='<input class="text-input " type="password" name="password1"  />';
                str+="</p>";
                str+='<p><input class="button" type="submit" value="Sign In" /></p>';

                $("form").append(str);

            }else{
                $(".code_error").html("验证码输入错误");
            }
        })

    })

    $("form").submit(function(){
        var password = $("input[name='password']").val();
        var password1 =$("input[name='password1']").val();
        if(password!=password1){
            alert("两次输入的密码不一致");
            return false;
        }
    })
</script>