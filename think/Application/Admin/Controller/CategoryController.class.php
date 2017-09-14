<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends PublicController {
	
	//递归函数：
	 public function category ($pid=0,$category=array(),$level=0){
		
	 	$arr=M("category")->where("`pid`='$pid'")->select();
	 	
	   // print_r($arr);die;
		//循环查询子集：
		foreach ($arr as $k => $v) {
			//循环拼接标识符：
			 for ($i=1; $i <= $level; $i++) {
				$str="";
				$str.="<span style='color:red'>";
				$str.="|-";
				$str.="</span>";
				$v["name"]=$str.$v["name"];
			}
			 
			//接收子集储存：
			$category[]=$v;
			//print_r($category);die;
			//调用函数本身，传递参数，重复查询子集：
			$category=$this->category($v["id"],$category,$level+1);
			
		}
		
		//返回数据给函数本身使用：
		return $category;
	}
	
	
	
	//index分页方法：
	public function index() {
		//实例化数据库表查询数据：
		
		$category=$this->category();
		//print_r($category);die;
		$this->assign("category",$category);
		//加载模板
		$this->display();
	}
	
	
	//insert页面方法
	public function insert(){
        
		$category=$this->category();
		//print_r($category);die;
		$this->assign("category",$category);
		
		//print_r($category);die;
		//判断是否是post：
		if (IS_POST){
			//print_r($_POST);die;
			//调用新增：
			$result=M("category")->data($_POST)->add();
			if ($result>0){
				$this->redirect("Category/index");
			}else {
				$this->error("新增失败！");
			}
		}
			
		//加载模板
		$this->display();
	
	}
	
	
	//分类删除
	public function delete(){
		if (IS_GET){//判断删除是否触发
			$id=$_GET["id"];
			
			//print_r($id);die;
			$category=$this->category($id);
			//print_r($category);die;
			if (!empty($category)){
			//循环删除每一个子集：
				foreach ($category as $k => $v) {
					//调用函数删除子集：
					//print_r($v);die;
					$condition['id'] =$v["id"];
					$result=M('category')->where($condition)->delete();
				}
				
			}
			$result=M('category')->where("`id`=$id")->delete();
			
			if ($result>0){
				$this->redirect("Category/index");
			}else {
				$this->error("删除失败！");
			}
		}
	
	}

	
	//分类修改--------------------------------------------------------------------------------
	//封装函数：
	function getCategory($id,$category=[]){
		if ($id!=0) {
	
			$arr=M("category")->where("`id`=$id")->find();
	        $pid=$arr["pid"];
			//当当前需要查找的那条记录查找出来之后，再次查找当前点击那条记录的所有同级：
			
	        $arrtj=M("category")->where("`pid`=$pid")->select();
	        
			//存储当前记录同级数据：
			$category[$id]=$arrtj;
	
			$category=$this->getCategory($arr["pid"],$category);
		}
		//返回值：
		return $category;
	} 
	
	
	Public function update(){
		if(IS_GET){
			$id=$_GET["id"];
			
			//判断ajax
			if (IS_AJAX){
				$id = I("get.id");
				 //echo  $_GET["id"];die;
				$zi=M("category")->where(array("pid"=>$id))->select();
				
				if (!empty($zi)){
					
				  echo json_encode($zi);die;
				  
				}else{
					echo 0;die;
				}
			}
			
			$category=$this->getCategory($id);
			//print_r($category);die;
			$category=array_reverse($category,true);
			//print_r($category);die;
			$this->assign("category",$category);
			$current=M("category")->where("`id`=$id")->find();
			$this->assign("current",$current);
			//print_r($current);die;
			
		}
	
		if (IS_POST){
			//print_r($_POST);die;
			$id=I("get.id");
			//print_r($id);die;
			$Model = M('category');
			$condition["id"]=$id;
			//print_r($id);die;
			$result=$Model->data($_POST)->where($condition)->save();
			if ($result>0){
				$this->redirect("Category/index");
			}else{
				$this->error("修改失败");
			}
		}
		
		
		
		
		
		//加载模板：
		$this->display();
	
	
	}
	 
	
	
}