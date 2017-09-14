<!DOCTYPE html>
<html>
<head>
</head>
<body>
 <div>头</div>
<div>zhon</div>
<div>尾{{$a}}</div>{{--注意：在模板中输出传参的内容一定是两个大括号，除此之原生的php输出方法也可以：--}}
 <div>尾<?=$a?></div>
 <div>尾<?php echo $a?></div>
{{--模板中php函数的使用:例如：截取字符串--}}
 <div>尾{{substr('dsbfvdsjfdefsdbdsd',0,8)}}</div>

 <div>{{$arr["id"]}}</div>

<hr/>
{{$b}}{{--这里的输出$b因为在php页面就包含了标签：$b='<b>dsjfcdsabhdksa</b>';，所以这里会包含标签一起原样输出，但是原生的不会--}}
<br/>
<?=$b?>
<br/>
 {{--想要带着标签一起输出但又不能把标签输出：{!! $b !!}:他的作用是解析变量但是不解析标签同时过滤标签--}}
{!! $b !!}

</body>
</html>
