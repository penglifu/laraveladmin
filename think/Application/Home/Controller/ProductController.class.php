<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends PublicController {
    public function ProductCenter(){
    	
    	//加载分类：
    	//判断视图页面传递的id是否存在，不存在默认显示第一个，它的id为2
    	$id=!empty($_GET["id"])?$_GET["id"]:0;
    	$this->assign("id",$id);
    	$User = M("category"); // 实例化User对象
    	$category=$User->where("`pid`=6")->select();
    	$this->assign("category",$category);
    	//index分页方法：
    	//实例化数据库表查询数据：
    	$num=6;
    	$User = M('product'); // 实例化news表对象
    	if(!empty($id)){
    	$count = $User->where("`category`=$id")->count();// 查询满足要求的总记录数
    	}else{
    		$count = $User->count();// 查询满足要求的总记录数
    	}
    	//print_r($count);die;
    	$Page = new \Home\Util\Pageone($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
    	$totalpages=$Page->totalPages;
    
    	$show = $Page->show();// 分页显示输出
    	if (!empty($id)){
    	$list = $User->where("`category`=$id")->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	}else{
    		$list = $User->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	}
    	//print_r($totalpages);die;
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
    	
    	
    	
    	if (!empty($_GET["content"])){
    		
    		$content=$_GET["content"];
    		//print_r($content);die;
    		$num=6;
	    	$User = M('product'); // 实例化news表对象
	    	$where['des'] = array('like', "%$content%");
	    	$where['title'] = array('like',"%$content%");
	    	$where["_logic"]="or";
	    	$count = $User->where($where)->count();// 查询满足要求的总记录数
	    	//print_r($count);die;
	    	$Page = new \Home\Util\Pageone($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
	    	$totalpages=$Page->totalPages;
	    
	    	$show = $Page->show();// 分页显示输出
	    	 
	    	$list = $User->where($where)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
	    	// echo  $User->getLastSql();die;
	    	//print_r($totalpages);die;
	    	$p=I("get.p",1);//获取当前页码，默认显示第一页
	    	
	    	$this->assign('list',$list);// 赋值数据集
	    	$this->assign('page',$show);// 赋值分页输出
	    	$this->assign('p',$p);//输出页码值
	    	//print_r($show);die;
	    	//print_r($list);die;
    		
    	}
    	
    	
    	
    	//加载模板
    	$this->display();
    }
    
    public function ProductCenterDetails(){
    	//加载分类：
    	//判断视图页面传递的id是否存在，不存在默认显示第一个，它的id为2
    	if (!empty($_GET["id"])){
    		$id=$_GET["id"];
    	
    	//print_r($id);die;
    	$User = M('product'); // 实例化news表对象
    	$one=$User->where("`id`=$id")->find();//根据id查找category
    	//print_r($one["category"]);die;
    	$categoryone=$one["category"];
    	//print_r($categoryone);die;
    	$this->assign("categoryone",$categoryone);
    	$User = M("category"); // 实例化User对象
    	$category=$User->where("`pid`=6")->select();
    	//print_r($category);die;
    	$this->assign("category",$category);
    	
    	$User = M('contact'); // 实例化contact表对象
    	$list1 = $User->where("`id`=1")->find();
    	$this->assign("list1",$list1);

    	$User = M('banner'); // 实例化banner表对象
    	$list2 = $User->order('time DESC')->limit(0,3)->select();
    	$this->assign("list2",$list2);
    	
    	//实例化数据库表查询数据：
    	$User = M('product'); // 实例化news表对象
    	$id=I("get.id");
    	//print_r($id);die;
    	$thick=[];
    	$arrsize=[];
    	$arrimages=[];
    	
    	$list=$User->where("`id`=$id")->find();//根据id查找category
    	//转化字符串
    	//print_r($list);die;
    	$thickness=json_decode($list["thickness"]);
    	$thick["thickness"]=$thickness;
    	$thickrepertory=json_decode($list["thickrepertory"]);
    	$thick["thickrepertory"]=$thickrepertory;
    	
    	$numthick=array_sum($thickrepertory);
    	$this->assign("numthick",$numthick);
    	//print_r($numthick);die;
    	    $arr=[];
    		foreach($thick["thickness"] as $k=>$v){
    			$arr[] = array_column($thick,$k);//在一个二维数组中取出k相同的 值；
    	
    		}
    		//print_r($arr);die;
    		$arr1=[];
    	$size=json_decode($list["size"]);
    	$arrsize["size"]=$size;
    	$sizerepertory=json_decode($list["sizerepertory"]);
    	$arrsize["sizerepertory"]=$sizerepertory;
    	
    	foreach($arrsize["size"] as $k=>$v){
    		$arr1[]= array_column($arrsize,$k);//在一个二维数组中取出k相同的 值；
    	   
    	}
    	
    	
    	$images=json_decode($list["images"]);
    	$arrimages["images"]=$images;
    	$colorrepertory=json_decode($list["colorrepertory"]);
    	$arrimages["colorrepertory"]=$colorrepertory;
    	$arr2=[];
    	foreach($arrimages["images"] as $k=>$v){
    		$arr2[] = array_column($arrimages,$k);//在一个二维数组中取出k相同的 值；
    	
    	}

    	$list["arr"]=$arr;
    	$list["arr1"]=$arr1;
    	$list["arr2"]=$arr2;
       // print_r($list);die;
    	$this->assign("list",$list);
    	
    }
    	
    if (!empty($_POST)){
    	
    	$username=session("username");
    	if (!empty($username)){
    	
    	$_POST["username"]=$username;
    	$_POST["time"]=date("Y-m-d",time());
    	
    	$submit=$_POST["submit"];
    	//print_r($id);die;
    	$_POST["product_id"]=$id;
    	
    	$ordernum=time().rand(100000, 999999);
    	$_POST["ordernum"]=$ordernum;
    	//print_r($_POST);die;
    	
    	if ($submit=="立即购买"){
    		$state="a";
    		$_POST["state"]=$state;
    		
    		//调用新增：
    		$result=M("shopping")->data($_POST)->add();
    		if ($result>0){
    			$this->redirect("MemberCenter/MakeSureTheOrderAndTheAddress",array('id' =>$id,"state"=>$state));
    		}else {
    			$this->error("购买失败！");
    		}
    		
    	}else {
    		$state="b";
    		$_POST["state"]=$state;
    		
    		//调用新增：
    		$result=M("shopping")->data($_POST)->add();
    		if ($result>0){
    			$this->redirect("MemberCenter/ShoppingCart",array('id' =>$id));
    		}else {
    			$this->error("购买失败！");
    		}
    		
    		
    		
    	}
    	
    	
      }else {
      	$this->redirect("Login/login");
      	
      }
    	
    }
    	
    
    $User = M('product'); // 实例化news表对象
    $on=$User->where("`id`=$id")->find();//根据id查找category
    $des=$on["des"];
    //print_r($des);die;
    $time=date("Y-m",time());
    //print_r($time);die;
    $sales=M("details")->where(array("time2"=>$time,"des"=>$des))->getField('number',true);
    
    $sal=array_sum($sales);
    $this->assign("sal",$sal);
    //print_r($sal);die; 
    	//加载模板
    	$this->display();
    }
    
    
   
    
    
}