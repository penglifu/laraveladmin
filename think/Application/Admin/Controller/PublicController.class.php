<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
	//重写构造函数：
	public function __construct(){
		//如果用户访问构造函数当中的每一个操作都会先访问构造函数：因为构造函数是储存在服务器的，因为每个页面都需要进行登录验证：
		//如果子类继承父类，重写构造函数都必须调用父级的构造函数：parent::__construct();
		parent::__construct();
		//在构造函数中调用验证登陆函数，验证访问的每个页面：
		
		$this->user();
		$all=$this->sidemeun();
		$this->assign("all",$all);
	}
	
	
	
	
	
	public function user(){
		$names=session("names");
		$names1=cookie("names");
		//print_r($username);die;
	if (ACTION_NAME!="loginout"){
		if(CONTROLLER_NAME!="Login" && ACTION_NAME!="vcode" ){
			if(empty($names) && empty($names1)){
					
				$this->redirect("Login/login");
					
			}
		}
	 }
	}
	
	
	
	public function username(){
		if (session("?names")&& !empty(cookie("names")) ){//判断session，cookie是否为空
			session("names",cookie("names"));//把cookie存到session当中
		}
		
		
		
		
	}
	
	public  function sidemeun($all=array()) {
		
		$names=session("names");
		
		// print_r($username);die;
		$l=M("admin")->where(array("names"=>$names))->find();
		
		$level=$l["level"];
		$w=M("level")->where(array("id"=>$level))->find();
		$level1=json_decode($w["level"]);
		//print_r($level1);die;
		foreach ($level1 as $k1=>$v1){
	  	//实例化数据库表meun
		$User = M("meun"); // 实例化User对象
		$condition['id'] =$v1;
		$arr=$User->where($condition)->select();
		
	    //循环添加数组到$arr中
		 foreach ($arr as $v){
		 	
           //以zi为下标添加数组：
		   $v["zi"] =$User->where("`pid`=".$v['id'])->select();
		   $all[]=$v;
          
	     } 
	     
		}  
	    // print_r($all);die;
	   
	     return $all;
	
	 
		//print_r($all);die;
	}
	
	
	
	public function vcode(){
		 
		//验证码：
		$config = array(
				'fontSize' => 20, // 验证码字体大小
				'length' => 4, // 验证码位数
				'useNoise' => true, // 关闭验证码杂点
				'imageW' =>180,
				'imageH' =>40,
		);
		$Verify = new \Think\Verify($config);
		if (IS_AJAX){
			 
			$param=$_POST['param'];
			/*  if ($Verify->check($param, "")){
			 echo y;die;
			 }else{
			 echo "验证码输入错误！";die;
			}*/
	
			 
	
			//第二种方法的：
			if($this->check_verify($param,"")){
				echo y;die;
	
			}else {
				echo "验证码输入错误！";die;
			}
	
		}
	
		$Verify->entry();//生成图片
		 
		 
		 
	}
	 
	
	function check_verify($param, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($param, $id);
	}
	
	
	
	
}