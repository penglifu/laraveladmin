<?php
namespace Home\Controller;
use Think\Controller;
class ContactUsController extends PublicController{
    public function ContactUs(){
    	if (IS_POST){
    		//追加当前时间
    		$_POST["time"]=date("Y-m-d H:i:s",time());
    		//print_r($_POST);die;
    		//调用新增：
    		$result=M("message")->data($_POST)->add();
    		if ($result>0){
    			echo "<script>alert('留言成功！')</script>";
    		}else {
    			echo "<script>alert('留言失败！')</script>";
    		}
    		
    		
    	}
    	
    	
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