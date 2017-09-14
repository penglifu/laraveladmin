<?php
namespace Admin\Controller;
use Think\Controller;
class MessageadminController extends PublicController {
	//index分页方法：
	public function index() {
		//实例化数据库表查询数据：
		$num=8;
		$User = M('admin'); // 实例化news表对象
		$count = $User->count();// 查询满足要求的总记录数
		$Page = new \Admin\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
		$show = $Page->show();// 分页显示输出
		$list = $User->field("admin.*,level.name")->join('LEFT JOIN __LEVEL__ ON __ADMIN__.level = __LEVEL__.id' )->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$p=I("get.p",1);
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('p',$p);
		//print_r($show);die;
		//print_r($list);die;
	
		//加载模板
		$this->display();
	}
	
	//管理员新增
	Public function insert(){
	
		if (IS_AJAX){
			if ($_POST["name"]=="names"){
				$param=$_POST["param"];
				$arr=M('admin')->where("`names`='$param'")->find();
				
				if (!empty($arr)){
					echo "用户名重复！";die;
				}else{
		
					echo y;die;
						
				}
			}else{
				
				$param=$_POST["param"];
				$arr=M('admin')->where("`email`='$param'")->find();
				
				if (!empty($arr)){
					echo "邮箱重复！";die;
				}else{
				
					echo y;die;
				
				}
			}
		
		}
		if(IS_POST){
				
			$_POST["password"]=md5($_POST["password"]);
			
			//追加时间字段：
			$_POST["time"]=date("Y-m-d H:i:s",time());
			//print_r($_POST);die;
			$result= M('admin')->data($_POST)->add();
			if ($result>0){
				$this->redirect("Messageadmin/index");
			}else {
				$this->error("修改失败！");
			}
	
		}
		//加载权限
		$level=M('level')->select();
	    $this->assign("level",$level);
	    //print_r($level);die;
		//加载模板
		$this->display();
	}
	
	//删除
	public function delete(){
		if (IS_GET){//判断删除是否触发
			$id=$_GET["id"];
			$Model = M('admin');
			$condition['id'] =$id;
			$arr=$Model->where($condition)->find();
			
			$result=$Model->where($condition)->delete();
			if ($result>0){
				$this->redirect("Messageadmin/index");
			}else {
				$this->error("删除失败！");
			}
		}
	
	}
	
	
	//修改
	Public function update(){
	
	
		if(IS_GET){
			$id=$_GET["id"];
			//print_r($id);die;
			$User = M('admin');
			$arr=$User->where("`id`='$id'")->find();
			//print_r($arr);die;
			$this->assign("arr",$arr);
			
			//加载权限
			$level=M('level')->select();
			$this->assign("level",$level);
			//print_r($level);die;
	
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
			//追加时间字段：
			$_POST["time"]=date("Y-m-d H:i:s",time());
			$_POST["password"]=md5($_POST["password"]);
			$id=I("get.id");
			$User = M('admin');
			$result=$User->data($_POST)->where("`id`='$id'")->save();
			if ($result>0){
				$this->redirect("Messageadmin/index");
			}else {
				$this->error("修改失败！");
			}
	
		}
	
	
		//加载模板
		$this->display();
	}	
	
	
	
	
	
	
}