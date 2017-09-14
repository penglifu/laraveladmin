<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
	//重写构造函数：
	
	public function __construct(){
		//如果用户访问构造函数当中的每一个操作都会先访问构造函数：因为构造函数是储存在服务器的，因为每个页面都需要进行登录验证：
		//如果子类继承父类，重写构造函数都必须调用父级的构造函数：parent::__construct();
		
		
		parent::__construct();
		//在构造函数中调用验证登陆函数，验证访问的每个页面：
		//$this->checkLogin();
		//头部导航
		$this->admin();
		$arr=$this->sideheader();
		$this->assign("arr",$arr);
		$shop=$this->shop();
		//print_r($shop);die;
		$this->assign("shop",$shop);
		
		
		
	}
	
	
	
	
	public function admin(){
		$username=session("username");
		if (!empty($username)){
			$this->assign("username",$username);
		}
		//print_r($username);die;
		
		
	}
	
	
	
	
	
	
	
	
	
    //加载头部导航
    public function sideheader(){
    	//实例化数据库表meun
    	$User = M("homemeun"); // 实例化User对象
    	
    	$arr=$User->select();
    	//print_r($arr);die;
    	return $arr;
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
    	   
    
    public function shop(){
    	//实例化数据库表meun
    	$User = M("shopping"); // 实例化User对象
    	$username=session('username');
    	//print_r($username);die;
    	$shop=$User->where(array("state"=>"b","username"=>$username))->count();
    	//echo $User->getLastSql();die;
    	//print_r($shop);die;
    	return $shop;
    }

    
}