<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends PublicController {
    public function login(){
    	if (IS_POST){
    		//print_r($_POST);die;
    		$username=I("post.username");
    		//print_r($username);die;
       		$password=md5(I("post.password"));
       		
    		$result=M("siteadmin")->where("`username`='$username' AND `password`='$password'")->find();
    		if ($result ){
    			//登陆成功把用户名存到session中：
    			session("username",$username);
    			//存到cookie中：
    			cookie("username",$username,time()+60*60);
    			
    			$this->redirect("Index/index");
    			
    		}else {
    			$this->error("登陆失败",U("Login/login"),3);die;
    		}
    		
    	}
    	
    	//加载模板
    	$this->display();
    }
    
    public function loginout(){
    	//清除session和cookie：
        session("username",null);
        cookie("username",null);
        //跳转到登陆页面：
       $this->redirect("Login/login");
    }
    
    public function getpassword(){
    	
    	if(IS_AJAX){
    	
    		if(md5($_POST["code"])==$_COOKIE["code"]){
    		 echo 1;die;
    		}else{
    		 echo 0;die;
    		}
    	}
    	
    	if(!empty($_POST)){
    	
    		$email=$_POST["email"];
    		unset($_POST["code"]);
    		$_POST["password"]=md5($_POST["password"]);
    		$result=M("siteadmin")->data($_POST)->where(array("email"=>$email))->save();
    	
    		if($result>0){
    			$this->success("修改成功！",U("Login/login"),5);
    		}else{
    			echo "<script>alert('修改失败')</script>";
    		}
    	}
    	 
    	
    	
    	//加载模板
    	$this->display();
    }
    
    
    public function sendemail(){
    	//print_r(1);die;
    	$code = rand(100000,999999);
    	cookie("code",MD5($code),time()+2*60);//将code存放在cookie中
    	Vendor("Phpmailer.phpmailer.phpmailer");
      	$mail             = new \PHPMailer();//实例化一个邮件发送类
    	$body             = "验证码为:$code";//设置邮件发送内容
    	$mail->IsSMTP(); // telling the class to use SMTP 使用smtp协议发送
    	$mail->SMTPDebug  = 0;//错误调试：0表示不打开错误调试
    	$mail->SMTPAuth   = true;
    	$mail->CharSet    = "utf-8";
    	$mail->Host       = "smtp.163.com"; // sets the SMTP server 设置发送邮件服务器，如：smtp.qq.com
    	$mail->Port       = 25;                    // set the SMTP port for the GMAIL server 邮件发送服务的端口
    	$mail->Username   = "penglifu123@163.com"; // SMTP account username 发送邮件的邮箱用户名，如：123@qq.com
    	$mail->Password   = "penglifu123";        // SMTP account password 发送邮件的邮箱密码，如：123456，是123@qq.com的密码
    	$mail->SetFrom('penglifu123@163.com', 'plf');//设置接收来源，如：123@qq.com
    	$mail->AddReplyTo("penglifu123@163.com","plf");//回复邮箱，如果别人按回复按钮，会直接指定的回复邮箱
    	$mail->Subject    = "找回密码";//标题,主题
    	$mail->MsgHTML($body);//内容使用html格式
    	
    	$address = $_POST["email"];//接收方的邮箱地址
    	
    	$mail->AddAddress($address, "用户组");//有多个邮箱地址，使用多次
    	// $mail->Send();//发送邮件
    	$mail->Send();
    	
    	echo 1;
    	
    	 
    	 
    	
    }
    
    
    
    
    
    
    
    
    
    
    
}