<?php
namespace Admin\Controller;
use Think\Controller;
class DetailController extends PublicController {
	
		//index分页方法：
		public function index() {
			
			if (IS_POST){
				$id=$_POST['id'];
				$fahuo= "已发货";
				$result1=M('details')->where("`id`='$id'")->setField('fahuo',$fahuo);
				if ($result1>0){
					echo 0;die;
				}else {
					echo 1;die;
				}
				 
			
			}
			
			
			
			//实例化数据库表查询数据：
			$num=8;
			$User = M('details'); // 实例化news表对象
			$count = $User->count();// 查询满足要求的总记录数
			$Page = new \Admin\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
			$show = $Page->show();// 分页显示输出
			$list = $User->order('time1 DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
			$p=I("get.p",1);
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('p',$p);
			//print_r($show);die;
			//print_r($list);die;
	
			//加载模板
			$this->display();
		}
		
		

		Public function check(){
			if(IS_GET){
				$id=$_GET["id"];
				//print_r($id);die;
				$User = M('details');
				$arr=$User->where("`id`='$id'")->find();
				//print_r($arr);die;
				$this->assign("arr",$arr);
		
				$this->display();
		
			}
				
				
		}
		
		
		//删除
		public function delete(){
			if (IS_GET){//判断删除是否触发
				$id=$_GET["id"];
				$Model = M('details');
				$condition['id'] =$id;
				$arr=$Model->where($condition)->find();
					
				$result=$Model->where($condition)->delete();
				if ($result>0){
					$this->redirect("Detail/index");
				}else {
					$this->error("删除失败！");
				}
			}
		
		}
		
		
		
		
		
		
		
		
			
	
		
		
}