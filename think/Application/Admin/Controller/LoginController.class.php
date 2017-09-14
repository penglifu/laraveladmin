<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends PublicController {
	   //登陆：
       public function Login(){
       	//header("Content-Type:text/html; charset=utf-8");//入口处没有这里需要添加
        	if (IS_POST){
       		//print_r($_POST);die;
       		//$_POST["password"]=md5($_POST["password"]);
       		$names=I("post.names");
       		$password=md5(I("post.password"));
       		$result=M("admin")->where("`names`='$names' AND `password`='$password'")->find();
       		//print_r($result);die;
       		if ($result){
       			//登陆成功把用户名存到session中：
       			session("names",$names);
       			
       			//判断是否点击remember：
       			if (!empty(I("post.remember"))){
       				//点击了存到cookie中：
       				cookie("names",$names,time()+60*60);
       				
       			}
       			
       			$this->redirect("News/index");
       			//$this->redirect("News/index",array(),5,"登陆成功正在跳转。。。");
       			//设置跳转时长array()必不可少
       		
       		}else {
       			$this->error("用户名或密码错误！",U("Login/login"),3);die;
       			//echo "<script>alert('用户名或密码错误')</script>";
       		}
       	} 
       	
    
       	$this->display();
       	
       }
       
       //退出登陆：
      public function Loginout(){
        //清除session和cookie：
        session("names",null);
        cookie("names",null);
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
    
      	
      	
		unset($_POST["password1"]);
    		unset($_POST["code"]);
    		$email=$_POST["email"];
    		$_POST["password"]=md5($_POST["password"]);
    		//print_r($_POST);die;
    		$result=M("admin")->data($_POST)->where(array("email"=>$email))->save();
		
			if($result){
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