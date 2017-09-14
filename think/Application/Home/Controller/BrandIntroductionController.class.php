<?php
namespace Home\Controller;
use Think\Controller;
class BrandIntroductionController extends PublicController{
    public function BrandIntroduction(){
    	//加载分类：
    	//判断视图页面传递的id是否存在，不存在默认显示第一个，它的id为2
    	$id=!empty($_GET["id"])?$_GET["id"]:12;
    	$this->assign("id",$id);
    	$User = M("category"); // 实例化User对象
    	$category=$User->where("`pid`=11")->select();
    	$this->assign("category",$category);
    	
    	$User = M('Brand'); // 实例化Brand表对象
    	$list = $User->where("`category`=$id")->find();
    	$images=json_decode($list["images"]);
    	$list["images"]=$images;
    	$this->assign("list",$list);
    	//print_r($list);die;
    	
    	$User = M('contact'); // 实例化contact表对象
    	$list1 = $User->where("`id`=1")->find();
    	$this->assign("list1",$list1);
    	
    	$User = M('banner'); // 实例化banner表对象
    	$list2 = $User->order('time DESC')->limit(0,3)->select();
    	$this->assign("list2",$list2);
    	//print_r($list2);die;
    	//加载模板
    	$this->display();
    }
}