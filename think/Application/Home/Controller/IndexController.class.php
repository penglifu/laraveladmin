<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends PublicController{
    public function index(){
    	$User = M('category'); // 实例化news表对象
    	$one=$User->where("`id`=7")->find();//根据id查找category
    	$two=$User->where("`id`=8")->find();//根据id查找category
    	$three=$User->where("`id`=9")->find();//根据id查找category
    	$this->assign("one",$one);
    	$this->assign("two",$two);
    	$this->assign("three",$three);
    	
    	
    	$User = M('product'); // 实例化news表对象
    	$list7=$User->where("`category`=7")->order('time DESC')->find();//根据id查找category
    	//print_r($list7);die;
    	$introduce=$list7["introduce"];
    	$list7["introduce"]=json_decode($introduce);
    	$images=$list7["images"];
    	$list7["images"]=json_decode($images);
    	$this->assign("list7",$list7);
    	
    	$list8=$User->where("`category`=8")->order('time DESC')->find();//根据id查找category
    	//print_r($list8["id"]);die;
    	$introduce=$list8["introduce"];
    	$list8["introduce"]=json_decode($introduce);
    	$images=$list8["images"];
    	$list8["images"]=json_decode($images);
    	$this->assign("list8",$list8);
    
    	$list9=$User->where("`category`=9")->order('time DESC')->find();//根据id查找category
    	//print_r($list9);die;
    	$introduce=$list9["introduce"];
    	$list9["introduce"]=json_decode($introduce);
    	$images=$list9["images"];
    	$list9["images"]=json_decode($images);
    	$this->assign("list9",$list9);
    	//print_r($list9);die;
    	//加载模板
    	$this->display();
    }
}