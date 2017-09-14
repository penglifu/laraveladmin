<?php
namespace Admin\Controller;
use Think\Controller;
class BrandintroductionController extends PublicController {
	//定义图片路径：
	public $path= './Uploads/Brand/';//上传文件的路径文件夹
	public $width=100;//图片宽度
	public $height=100;//图片高度
	//产品图片上传
	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		if (!file_exists($this->path)){//判断定义的路径是否存在
			mkdir($this->path,0777,true);
		}
		$upload->rootPath = $this->path; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录 // 上传文件
	
		//上传文件
		$info = $upload->upload();
		//print_r($info);die;
		$images=[];
		$thumb_img=[];
		$water_img=[];
		//设置原图上传图片的路径：$info为一个数组
		foreach ($info as $v){
			$origin_imags=$this->path.$v["savepath"].$v["savename"];//单张原图路径
			$images[]=$origin_imags;
		
	   $image = new \Think\Image();//实例化的是Think命名空间下的Image()不能更改设置缩略图根文件所在
	  //处理缩略图----------------------------------------
		
		$image->open($origin_imags);//打开路径下的那张原图， 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
		$thumb_path=$this->path.$v["savepath"]."thumb_".$v["savename"];//拼接缩略图路径
		$image->thumb($this->width, $this->height,6)->save($thumb_path);//6代表生成宽高一致的缩略图
		$thumb_img[] = $thumb_path;
		
	   //处理水印图-------------------------------------------
		$image->open($origin_imags)->water('./shuiyin.png',1);
		$water_path=$this->path.$v["savepath"]."water_".$v["savename"];//拼接缩略图路径
		$image->thumb($this->width, $this->height,6)->save($water_path);
		$water_img[]=$water_path;
		/* 水印字体：
		 $new_path=$this->path.$v["savepath"]."new_".$v["savename"];
		 $image->open($origin_imags)->text('ThinkPHP','./FZGLJW.TTF',20,'#000000',9)->save($new_path);
		 $new_img[]= $new_path;
		*/
		//print_r($water_img);die;
		}
		/* print_r($images);
		print_r($thumb_img);
		print_r($water_img);die; */
		
		//返回值
		return array("images"=>$images,"thumb_img"=>$thumb_img,"water_img"=>$water_img);
	}
	 
	
	
	
	
	
	//加载分页方法：
  
   //index分页方法：
   public function index() {
   	  //实例化数据库表查询数据：
   	$num=8;
   	$User = M('brand'); // 实例化news表对象
   	$count = $User->count();// 查询满足要求的总记录数
   	$Page = new \Admin\Util\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数$num
   	$show = $Page->show();// 分页显示输出
   	$list = $User->field("brand.*,category.name")->join('LEFT JOIN __CATEGORY__ ON __BRAND__.category = __CATEGORY__.id' )->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
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
   	$User = M("category"); // 实例化User对象
   	$category=$User->where("`pid`=11")->select();
   	$this->assign("category",$category);
   	//print_r($category);die;
   	//判断是否是post：
   	if (IS_POST){
   		
   		 //print_r($_POST);die;
   		//print_r($_FILES);die; 
   		$check_image=$_POST["check_image"];
   		unset($_POST["check_image"]);
   		$tmp_name=$_FILES["images"]["tmp_name"];
   		$images=[];
   		foreach ($tmp_name as $k=>$v){
   			if (in_array($k, $check_image)){
   				$images[]=$v;
   			}
   			
   		}
   		$_FILES["images"]["tmp_name"]=$images;
   		
   		$info=$this->upload();
   		//print_r($info);die;
   		//保存图片路径到数组post中存储数据库
   		$_POST["images"]=json_encode($info["images"]);
   		$_POST["thumb_img"]=json_encode($info["thumb_img"]);
   		$_POST["water_img"]=json_encode($info["water_img"]);
   		//print_r($_POST);die;
   		//追加时间字段：
   		$_POST["time"]=date("Y-m-d H:i:s",time());
   		//调用新增：
   		$result=M("Brand")->data($_POST)->add();
   		if ($result>0){
   			$this->redirect("Brandintroduction/index");
   		}else {
   			$this->error("新增失败！");
   		}
   	}
   	 
   	//加载模板
   	$this->display();
   
   }
   
   //删除页面
   public function delete(){
   	if (IS_GET){//判断删除是否触发
   		$id=$_GET["id"];
   		$Model = M('Brand');
   		$condition['id'] =$id;
   		$arr=$Model->where($condition)->find();
   		//print_r($arr);die;
   		if (!empty($arr["images"])){//判断图片是否存在
   			//转化图片格式
   			$images=json_decode($arr["images"]);
   			$thumb_img=json_decode($arr["thumb_img"]);
   			$water_img=json_decode($arr["water_img"]);
   			
   			//删除文件中图片
	   		foreach ($images as $k=>$v){
	   		if (file_exists($images[$k]))
	   			unlink($images[$k]);
	   		if (file_exists($thumb_img[$k]))
	   			unlink($thumb_img[$k]);
	   		if (file_exists($water_img[$k]))
	   			unlink($water_img[$k]);
	   		}
	   		
   		}
   		$result=$Model->where($condition)->delete();
   		if ($result>0){
   			$this->redirect("Brandintroduction/index");
   		}else {
   			$this->error("删除失败！");
   		}
   	}
   
   }
   
   //修改页面
 Public function update(){
  if(IS_GET){
   		$id=$_GET["id"];
   		//print_r($id);die;
   		$User = M("Brand"); // 实例化User对象
	   	 $condition['id'] =$id;
	   	 $arr=$User->where($condition)->find();//找出id对应的记录
	   	 $images=$arr["images"];
	   	 $arr["images"]=json_decode($images);
	   	 $this->assign("arr",$arr);
	   	//print_r($arr);die;
	   	 $category=$arr["category"];
	   	 $this->assign("category",$category);//传递当前分类的id
	   	 //print_r($category);die;
	   	 $User = M("category"); // 实例化User对象
	   	 $one=$User->where("`id`=$category")->find();
	   	 $pid=$one["pid"];
	   	 //print_r($pid);die;
	   	 $categoryall=$User->where("`pid`=$pid")->select();
	   	 //print_r($categoryall);die;
	   	 $this->assign("categoryall",$categoryall);
   	}
   
  if (IS_POST){
   		
   	 //处理图片上传-----------------------------------
   		$images=[];
   		$thumb_img=[];
   		$water_img=[];
   	 //处理新上传的图片是否上传的时候有删除-------------------------------------
      if (!empty($_POST["check_image"])){
   		$check_image=$_POST["check_image"];//获取上传图片的临时下标
   		unset($_POST["check_image"]);//数据库不存在对应的字段删除临时下标
   		$tmp_name=$_FILES["images"]["tmp_name"];//获取图片的临时路径
   		$imagesshang=[];
   		foreach ($tmp_name as $k=>$v){//循环多张图片
   			if (in_array($k, $check_image)){//判断图片的下标是否在传参过来的临时临时下标中
   				$imagesshang[]=$v;//保存在的临时路径
   			}
   		
   		}
   		$_FILES["images"]["tmp_name"]=$imagesshang;
   		$info=$this->upload();
   		//print_r($info);die;
   		//转化二维数组为一维数组
   		$images1=$info["images"];
   		foreach ($images1 as $v){
   			$images[]=$v;
   		}
   		$thumb_img1=$info["thumb_img"];
   		foreach ($thumb_img1 as $v){
   			$thumb_img[]=$v;
   		}
   		$water_img1=$info["water_img"];
   		foreach ($water_img1 as $v){
   			$water_img[]=$v;
   		}
   	  }	
   		//print_r($images1);die;
   		//处理新上传的图片是否上传的时候有删除-----------------------------------------
   		
   		
   		//处理原图图片是否全部删除--------------------------------------------
     if (!empty($_POST["images_old"])){
   		$images_old=$_POST["images_old"];//获取上传图片的临时下标
   		//print_r($images_old);die;
   		unset($_POST["images_old"]);//数据库不存在对应的字段删除临时下标
   		$Model = M('Brand');
   		$id=I('get.id');
   		$condition["id"]=$id;
   		$oldarr=$Model->where($condition)->find();
   		//print_r($oldarr);die;
   		$oldimages=json_decode($oldarr["images"]);
   		$oldthumb_img=json_decode($oldarr["thumb_img"]);
   		$oldwater_img=json_decode($oldarr["water_img"]);
   		//print_r($oldimages);die;
   		//保存原图没被删除的路径--------------------------------------
   		
   		foreach ($oldimages as $k=>$v){//循环多张图片
   			if (in_array($k, $images_old)){//判断图片的下标是否在传参过来的临时临时下标中
   				$images[]=$v;//保存在的临时路径
   			}else{
   				if (file_exists($oldimages[$k]))
   					unlink($oldimages[$k]);
   				
   			}
   			 
   		}
   		
   		
   		foreach ($oldthumb_img as $k=>$v){//循环多张图片
   			if (in_array($k, $images_old)){//判断图片的下标是否在传参过来的临时临时下标中
   				$thumb_img[]=$v;//保存在的临时路径
   			}else{
   				if (file_exists($oldthumb_img[$k]))
   					unlink($oldthumb_img[$k]);
   				
   			}
   				
   		}
   		
   		
   		foreach ($oldwater_img as $k=>$v){//循环多张图片
   			if (in_array($k, $images_old)){//判断图片的下标是否在传参过来的临时临时下标中
   				$water_img[]=$v;//保存在的临时路径
   			}else{
   				if (file_exists($oldwater_img[$k]))
   					unlink($oldwater_img[$k]);
   				
   			}
   				
   		}
   	 }else {//当前原图全部删除的时候：删除原图对应的所有图片
   	 	$Model = M('Brand');
   	 	$id=I('get.id');
   	 	$condition["id"]=$id;
   	 	$yuanarr=$Model->where($condition)->find();
   	 	//print_r($yuanarr);die;
   	 	$yuanimages=json_decode($yuanarr["images"]);
   	 	$yuanthumb_img=json_decode($yuanarr["thumb_img"]);
   	 	$yuanwater_img=json_decode($yuanarr["water_img"]);
   	 	//print_r($yuanimages);die;
   	 	foreach ($yuanimages as $k=>$v){
   	 		if (file_exists($yuanimages[$k]));
   	 			unlink($yuanimages[$k]);
   	 		if (file_exists($yuanthumb_img[$k]));
   	 			unlink($yuanthumb_img[$k]);
   	 		if (file_exists($yuanwater_img[$k]));
   	 			unlink($yuanwater_img[$k]);
   	 }
   	
   }
   	   //转化字符串
   		$_POST["images"]=json_encode($images);
   		$_POST["thumb_img"]=json_encode($thumb_img);
   		$_POST["water_img"]=json_encode($water_img);
   		//print_r($_POST);die;
   		
   		
   		//保存原图没被删除的路径--------------------------------------
   		
   		//追加时间字段：
   		$_POST["time"]=date("Y-m-d H:i:s",time());
   		//print_r($_POST);die;
   		$Model = M('Brand');
   		$id=I('get.id');
   		$condition["id"]=$id;
   		//print_r($id);die;
   		$result=$Model->data($_POST)->where($condition)->save();
   
   		if ($result>0){
   			$this->redirect("Brandintroduction/index");
   		}else{
   			$this->error("修改失败");
   		}

   	}
   	//加载模板：
   	$this->display();
   }
   
    
   
   
   
   
  
   
   
}