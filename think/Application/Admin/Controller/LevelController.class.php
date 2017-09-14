<?php
namespace Admin\Controller;
use Think\Controller;
class LevelController extends PublicController {
	//加载meun
 	public  function sidemeun($all=array()) {
		
	  	//实例化数据库表meun
		$User = M("meun"); // 实例化User对象
		$condition['pid'] =0;
		$arr=$User->where($condition)->select();
	    //循环添加数组到$arr中
		 foreach ($arr as $v){
           //以zi为下标添加数组：
		   $v["zi"] =$User->where("`pid`=".$v['id'])->select();
		   $all[]=$v;

	     }   
	  return $all;
		//print_r($all);die;
	}
	 
	
	//index分页方法：
	public function index() {
		//实例化数据库表查询数据：
		$num=8;
		$User = M('level'); // 实例化news表对象
		$count = $User->count();// 查询满足要求的总记录数
		$Page = new \Admin\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
		$show = $Page->show();// 分页显示输出
		$list = $User->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		$p=I("get.p",1);
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('p',$p);
		//print_r($show);die;
		//print_r($list);die;
	
		//加载模板
		$this->display();
	}
	
	

	//insert页面方法
	public function insert(){
		
		$sidemeun=$this->sidemeun();
		$this->assign("sidemeun",$sidemeun);
		//print_r($sidemeun);die;
		
		
		//判断是否是post：
		if (IS_POST){
			$_POST["level"]=json_encode($_POST["level"]);
			//print_r($_POST);die;
			//追加时间字段：
			$_POST["time"]=date("Y-m-d H:i:s",time());
			//调用新增：
			$result=M("level")->data($_POST)->add();
			if ($result>0){
				$this->redirect("Level/index");
			}else {
				$this->error("新增失败！");
			}
		}
		 
		//加载模板
		$this->display();
	
	}
	
	//权限删除
	public function delete(){
		if (IS_GET){//判断删除是否触发
			$id=$_GET["id"];
			
			$result=M('level')->where("`id`=$id")->delete();
				
			if ($result>0){
				$this->redirect("Level/index");
			}else {
				$this->error("删除失败！");
			}
		}
	
	}
	
	//权限修改
	Public function update(){
		
		$sidemeun=$this->sidemeun();
		$this->assign("sidemeun",$sidemeun);
		//print_r($sidemeun);die;
		
		if(IS_GET){
			$id=$_GET["id"];
			//print_r($id);die;
			$User = M("level"); // 实例化User对象
		 $condition['id'] =$id;
		 $arr=$User->where($condition)->find();
		 $arr["level"]=json_decode( $arr["level"]);
		 $this->assign("arr",$arr);
		 //print_r($arr);die;
		
		}
	
		if (IS_POST){
			 
			$_POST["level"]=json_encode($_POST["level"]);
			//追加时间字段：
			$_POST["time"]=date("Y-m-d H:i:s",time());
			//print_r($_POST);die;
			$Model = M('level');
			$id=I('get.id');
			$condition["id"]=$id;
			//print_r($id);die;
			$result=$Model->data($_POST)->where($condition)->save();
	
			if ($result>0){
				$this->redirect("Level/index");
			}else{
				$this->error("修改失败");
			}
		}
		//加载模板：
		$this->display();
	}
	
	 
	
	
	
	
	
	
}