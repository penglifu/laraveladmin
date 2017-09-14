<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends PublicController {
    public function NewsCenter(){
    	//加载分类：
    	//判断视图页面传递的id是否存在，不存在默认显示第一个，它的id为2
    	$id=!empty($_GET["id"])?$_GET["id"]:2;
    	$this->assign("id",$id);
    	$User = M("category"); // 实例化User对象
    	$category=$User->where("`pid`=1")->select();
    	$this->assign("category",$category);
    	//index分页方法：
    		//实例化数据库表查询数据：
    		$num=4;
    		$User = M('news'); // 实例化news表对象
    		$count = $User->where("`category`=$id")->count();// 查询满足要求的总记录数
    		//print_r($count);die;
    		$Page = new \Home\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    		$show = $Page->show();// 分页显示输出
    		$list = $User->where("`category`=$id")->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$p=I("get.p",1);//获取当前页码，默认显示第一页
    		$this->assign('list',$list);// 赋值数据集
    		$this->assign('page',$show);// 赋值分页输出
    		$this->assign('p',$p);//输出页码值
    		//print_r($show);die;
    		//print_r($list);die;
    		
    		$User = M('contact'); // 实例化contact表对象
    		$list1 = $User->where("`id`=1")->find();
    		$this->assign("list1",$list1);
    		 
    		$User = M('banner'); // 实例化banner表对象
    		$list2 = $User->order('time DESC')->limit(0,3)->select();
    		$this->assign("list2",$list2);
    	//加载模板
    	$this->display();
    }
    
    public function NewsCenterDetails(){
    	//加载分类：
    	//判断视图页面传递的id是否存在，不存在默认显示第一个，它的id为2
    	if (!empty($_GET["id"])){
    		$id=$_GET["id"];
    	}
    	$User = M('news'); // 实例化news表对象
    	$one=$User->where("`id`=$id")->find();//根据id查找category
    	//print_r($one["category"]);die;
    	$categoryone=$one["category"];
    	//print_r($categoryone);die;
    	$this->assign("categoryone",$categoryone);
    	$User = M("category"); // 实例化User对象
    	$category=$User->where("`pid`=1")->select();
    	$this->assign("category",$category);
    	//index分页方法：
    	//实例化数据库表查询数据：
    	$num=1;
    	$User = M('news'); // 实例化news表对象
    	$count = $User->where("`category`=$categoryone")->count();// 根据category字段查询满足要求的总记录数
    	//print_r($count);die;
    	$Page = new \Home\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    	$show = $Page->show();// 分页显示输出
    	$list = $User->where("`category`=$categoryone")->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$p=I("get.p",1);//获取当前页码，默认显示第一页
    	$this->assign('list',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->assign('p',$p);//输出页码值
    	//print_r($show);die;
    	//print_r($list);die;

    	$User = M('contact'); // 实例化contact表对象
    	$list1 = $User->where("`id`=1")->find();
    	$this->assign("list1",$list1);
    	
    	$User = M('banner'); // 实例化banner表对象
    	$list2 = $User->order('time DESC')->limit(0,3)->select();
    	$this->assign("list2",$list2);
    	//加载模板
    	$this->display();
    }
    
}