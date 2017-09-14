<?php
namespace Home\Controller;
use Think\Controller;
class MeCenterController extends PublicController {
	
	//重写构造函数：
	public function __construct(){
		//如果用户访问构造函数当中的每一个操作都会先访问构造函数：因为构造函数是储存在服务器的，因为每个页面都需要进行登录验证：
		//如果子类继承父类，重写构造函数都必须调用父级的构造函数：parent::__construct();
		parent::__construct();
		//在构造函数中调用验证登陆函数，验证访问的每个页面：
		$this->checkCenter();
	}
	
	
	
	public  function checkCenter(){
		
		$username=session("username");
		//print_r($username);die;
		if (empty($username)){
			$this->redirect("Login/login");
			
		}
		
	}
	
	
	
}