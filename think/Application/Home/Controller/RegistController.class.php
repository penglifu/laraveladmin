<?php
namespace Home\Controller;
use Think\Controller;
class RegistController extends PublicController{
    public function regist(){
    	
    	if(IS_AJAX){
    		if (!empty($_POST["name"]) && $_POST["name"]=="username"  ){
    		 if(!empty($_POST["param"])){
    		 	$param=$_POST["param"];
    			//print_r($username);die;
    			$arr=M("siteadmin")->where("`username`='$param'")->find();
    			if (!empty($arr)){
    				 echo "用户名已重复";
    			}else {
    			     echo y;	
    			} 
    		die;
    	   }
    	   
    	   
    		}else{
    			
    			if(!empty($_POST["param"])){
    				$param=$_POST["param"];
    				//print_r($username);die;
    				$arr=M("siteadmin")->where("`email`='$param'")->find();
    				if (!empty($arr)){
    					echo "邮箱已重复";
    				}else {
    					echo y;
    				}
    				die;
    			}
    			
    		}
    	}   
    	
    	if (IS_POST){
    		//清除不存在字段
    	    $password=md5($_POST["password"]);
    	    $_POST["password"]=$password;
    	    unset($_POST["useragreement"]);
    		unset($_POST["upassword"]);
    		//print_r($upassword);die;
    		//print_r($_POST);die;
    		$_POST["time"]=date("Y-m-d H:i:s",time());
    		$username=$_POST["username"];
    		$arr=M("siteadmin")->where("`username`='$username'")->find();
    		if (empty($arr)){
	   	 	//调用新增：
		   	 	$result= M("siteadmin")->data($_POST)->add();
	    		if ($result>0){
	    			$this->success("注册成功！",U("Login/login"),5);
	    		}else{
	    			echo "<script>alert('注册失败！')</script>";
	    		}
    		
    		}else {
    			echo "<script>alert('用户名已存在！')</script>";
    		}
    	}
    	//加载模板
    	$this->display();
    }
}