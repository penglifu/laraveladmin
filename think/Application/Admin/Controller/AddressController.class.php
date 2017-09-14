<?php
namespace Admin\Controller;
use Think\Controller;
class AddressController extends PublicController {
	//index分页方法：
	public function index() {
		//实例化数据库表查询数据：
		
		$User = M('contact'); // 实例化news表对象
		
		$list = $User->find();
		
		$this->assign('list',$list);// 赋值数据集
		
		
		//print_r($list);die;
	
		//加载模板
		$this->display();
	}
	 
	Public function update(){
		
		
		if(IS_GET){
			$id=$_GET["id"];
			//print_r($id);die;
			$User = M('contact');
			$arr=$User->where("`id`='$id'")->find();
			//print_r($arr);die;
			$this->assign("arr",$arr);

		}
		if (IS_AJAX){
			$param=$_POST["param"];
			$id=I("get.id");
			//print_r($id);die;
			$arr=M('admin')->where("`id`='$id'")->find();
			if (!empty($arr) && $arr["id"]!=I("get.id")){
				echo "验证失败！";die;
			}else{
				
				echo y;die;
					
			}
		}
		if(IS_POST){
			
			$id=I("get.id");
			$User = M('contact');
			$result=$User->data($_POST)->where("`id`='$id'")->save();
		if ($result>0){
					$this->redirect("Address/index");
				}else {
					$this->error("修改失败！");
				}
				
		}
		
		
		//加载模板	
		$this->display();
	}
	
	
}
	